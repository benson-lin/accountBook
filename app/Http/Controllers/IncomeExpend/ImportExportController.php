<?php
namespace App\Http\Controllers\IncomeExpend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\IncomeExpendRecordModel;
use App\Util\MVCUtil;
use App\Enum\TypeEnum;
use Maatwebsite\Excel\Facades\Excel;


class ImportExportController extends Controller
{
    
    public function exportRecords()
    {
        $userId = Session::get('user_id');
        $records = IncomeExpendRecordModel::where('user_id', $userId)->with('account')->with('incomeExpend')->orderBy('add_time', 'desc')->get()->toArray();
        
        $line = ['时间', '类型', '金额', '账户', '用途/来源', '备注'];
        $cellData[] = $line;
        
        foreach ($records as $record) {
            $addTime = $record['add_time'];
            $type = TypeEnum::getDisplay($record['type']);
            $money = $record['money'];
            $account = $record['account']['name'];
            $incomeExpend = $record['income_expend']['name'];
            $remark = $record['remark'];
            $d = [$addTime, $type, $account, $incomeExpend, $remark];
            $cellData[] = $d;
        }
        $rowNumber = count($line);
        $filename = date('Ymd', time()).'收支记录-'.rand(100,999);
        Excel::create($filename , function($excel) use ($cellData, $rowNumber){
            $excel->sheet('收支记录', function($sheet) use ($cellData, $rowNumber){
                $sheet->freezeFirstRow();
                $lineNumber = 1;//多少行
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
        return MVCUtil::getResponseContent(self::RET_SUCC);
    }
    
    
    
}

?>