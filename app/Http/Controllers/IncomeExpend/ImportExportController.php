<?php
namespace App\Http\Controllers\IncomeExpend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\IncomeExpendRecordModel;
use App\Util\MVCUtil;
use App\Enum\TypeEnum;
use Upload\Storage\FileSystem;
use Upload\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\IncomeExpendCategoryModel;
use App\Models\AccountCategoryModel;
use App\Util\ToolUtil;


class ImportExportController extends Controller
{
    
    public function exportRecords(Request $request)
    {
    	$createTimeGreater = $request->input("createTimeGreater");
    	$createTimeLess = $request->input("createTimeLess");
    	$addTimeGreater = $request->input("addTimeGreater");
    	$addTimeLess = $request->input("addTimeLess");
    	$updateTimeGreater = $request->input("updateTimeGreater");
    	$updateTimeLess = $request->input("updateTimeLess");
    	$moneyGreater = $request->input("moneyGreater");
    	$moneyLess = $request->input("moneyLess");
    	$accountCategoryId = $request->input("accountCategoryId");
    	$incomeExpendCategoryId = $request->input("incomeExpendCategoryId");
    	$type = $request->input("type");//1是收入的id，2是支出的id
    	$remark = $request->input("remark");
    	$userId = Session::get('user_id');
    	 
    	$builder = IncomeExpendRecordModel::where('user_id', $userId);
    	if (!empty($createTimeGreater)) {
    		$builder = $builder->where('create_time', '>=', $createTimeGreater);
    	}
    	if (!empty($createTimeLess)) {
    		$builder = $builder->where('create_time', '<=', $createTimeLess);
    	}
    	if (!empty($addTimeGreater)) {
    		$builder = $builder->where('add_time', '>=', $addTimeGreater);
    	}
    	if (!empty($addTimeLess)) {
    		$builder = $builder->where('add_time', '<=', $addTimeLess);
    	}
    	if (!empty($updateTimeGreater)) {
    		$builder = $builder->where('update_time', '>=', $updateTimeGreater);
    	}
    	if (!empty($updateTimeLess)) {
    		$builder = $builder->where('update_time', '<=', $updateTimeLess);
    	}
    	if (!empty($moneyLess)) {
    		$builder = $builder->where('money', '<=', $moneyLess);
    	}
    	if (!empty($moneyGreater)) {
    		$builder = $builder->where('money', '>=', $moneyGreater);
    	}
    	if (!empty($accountCategoryId)) {
    		$builder = $builder->where('account_category_id', $accountCategoryId);
    	}
    	if (!empty($incomeExpendCategoryId)) {
    		$builder = $builder->where('income_expend_category_id', $incomeExpendCategoryId);
    	}
    	if (!empty($type)) {
    		$builder = $builder->where('type', $type);
    	}
    	if (!empty($remark)) {
    		$builder = $builder->where('remark', 'like', '%'.$remark.'%');
    	}
    	
        $records = $builder->with('account')->with('incomeExpend')->orderBy('add_time', 'desc')->get()->toArray();
        
        $line = ['时间', '类型', '金额', '账户', '用途/来源', '备注'];
        $cellData[] = $line;
        
        foreach ($records as $record) {
            $addTime = $record['add_time'];
            $type = TypeEnum::getDisplay($record['type']);
            $money = $record['money'];
            $account = $record['account']['name'];
            $incomeExpend = $record['income_expend']['name'];
            $remark = $record['remark'];
            $d = [$addTime, $type, $money, $account, $incomeExpend, $remark];
            $cellData[] = $d;
        }
        $rowNumber = count($line);
        $filename = date('Ymd', time()).'收支记录-'.rand(100,999);
        Excel::create($filename , function($excel) use ($cellData, $rowNumber){
            $excel->sheet('收支记录', function($sheet) use ($cellData, $rowNumber){
                $sheet->freezeFirstRow();
                $lineNumber = 0;//多少行
                foreach ($cellData as $row){
                    $sheet->appendRow($row);
                    $lineNumber++;
                }
                $rowsNumber = \PHPExcel_Cell::stringFromColumnIndex($rowNumber-1);//$rowNumber=5时是F，因为是从0开始的，0对应A，所有这里减1
                $widthArray = [];
                for($i=0; $i<=$rowsNumber-1; $i++) {
                    $tempRow = \PHPExcel_Cell::stringFromColumnIndex($i);
                    $widthArray[$tempRow] = '100%';
                }
                $sheet->setWidth($widthArray);
                $sheet->cells('A1:'.$rowsNumber.$lineNumber, function($cells) {
                    $cells->setAlignment('center');//居中
                });
            });
        })->export('xls');
    }
    
    
    public function batchImportRecords(Request $request)
    {
    	$uploadDir = app()->storagePath().'/upload/';
    	if(!file_exists($uploadDir)) mkdir($uploadDir, 0755, true);
    	$filename = uniqid();
    	$storage = new \Upload\Storage\FileSystem($uploadDir);
        $file = new \Upload\File('recordsExcel', $storage);    	
    	$file->addValidations([
            new \Upload\Validation\Size('5M'),
            /** 上传附件支持'jpg', 'bmp', 'png', 'gif','txt','rar','zip','doc','docx','ini','conf','eml','xls','xlsx' 格式 */
            // new \Upload\Validation\Mimetype(['image/jpg', 'image/jpeg', 'image/bmp', 'image/png', 'image/gif', 'text/plain', 'application/x-rar', 'application/zip', 'application/msword', 'applicationnd.openxmlformats-officedocument.wordprocessingml.document', 'message/rfc822', 'applicationf', 'applicationnd.ms-office', 'applicationnd.openxmlformats-officedocument.spreadsheetml.sheet']),
        ]);
        $file->setName($filename);
        $filePath = $uploadDir.$filename.'.'.$file->getExtension();
        try {
            $file->upload();
            $records = [];
            Excel::load($filePath, function($reader){
               $allData = $reader->toArray();
               $firstTable = $allData[0];
               foreach ($firstTable as $i=>$oneLine) {
                    if($i==0)
                        continue;
                    $addTime = $oneLine[1];
                    $type = $oneLine[2];
                    $money = $oneLine[3];
                    $account = $oneLine[4];
                    $inEx = $oneLine[5];
                    $remark = $oneLine[6];
                    if(empty($addTime)||empty($type)||empty($money)||empty($account)||empty($inEx)){
                        continue;
                    }
                    $records[] = [
                        'add_time' => $addTime,
                        'user_id' => $this->userId,
                        'money' => $money,
                        'type' => TypeEnum::getKey($type),
                        'account_category_id' => AccountCategoryModel::getIdByName($account),
                        'income_expend_category_id' => IncomeExpendCategoryModel::getIdByName($inEx),
                        'remark' => $remark,
                    	'create_time' => ToolUtil::timetostr(time())
                    ];
               }
               IncomeExpendRecordModel::insert($records);
            });
            unlink($filePath);//删除临时文件
        } catch (\Exception $e) {
            $errors = $file->getErrors();
            return MVCUtil::getResponseContent(self::RET_FAIL, json_encode($errors));
        }
        return MVCUtil::getResponseContent(self::RET_SUCC, '导入成功');
    }
}

?>