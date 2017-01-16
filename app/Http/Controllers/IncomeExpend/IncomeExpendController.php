<?php

namespace App\Http\Controllers\IncomeExpend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\IncomeExpendRecordModel;
use App\Util\MVCUtil;

class IncomeExpendController extends Controller {
	
	public function queryRecords(Request $request)
	{
	    $createTimeGreater = $request->input("createTimeGreater");
	    $createTimeLess = $request->input("createTimeLess");
	    $updateTimeGreater = $request->input("updateTimeGreater");
	    $updateTimeLess = $request->input("updateTimeLess");
	    $moneyGreater = $request->input("moneyGreater");
	    $moneyLess = $request->input("moneyLess");
	    $accountCategoryId = $request->input("accountCategoryId");
	    $incomeExpendCategoryId = $request->input("incomeExpendCategoryId");
	    $type = $request->input("type");//1是收入的id，2是支出的id
	    $remark = $request->input("remark");
	    $page = $request->input("page", 1);
	    $limit = $request->input("limit", 15);
	    $userId = Session::get('user_id');
	    
	    $builder = IncomeExpendRecordModel::where('user_id', $userId);
	    if (!empty($createTimeGreater)) {
	        $builder = $builder->where('create_time', '>=', $createTimeGreater);
	    }
	    if (!empty($createTimeLess)) {
	        $builder = $builder->where('create_time', '<=', $createTimeLess);
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
	        $builder = $builder->where('account_id', $accountCategoryId);
	    }
	    if (!empty($incomeExpendCategoryId)) {
	        $builder = $builder->where('income_expend_category_id', $incomeExpendCategoryId);
	    }
	    if (!empty($type)) {
	        $builder = $builder->where('type', $type);
	    }
	    if (!empty($remark)) {
	        $builder = $builder->where('remark', 'like', $remark);
	    }
	    $result = $builder->with('account')->with('incomeExpend')
	       ->orderBy('update_time', 'desc')
	       ->paginate($limit)->toArray();
	    $data = [
	       'total' => $result['total'],
	       'data' => $result['data'],
	    ];
	   return MVCUtil::getResponseContent(self::RET_SUCC, '', $data);    
	}
	
	
	public function addRecord(Request $request)
	{
	    $type = $request->input("type");//1是收入，2是支出
	    $money = $request->input("money");
	    $addTime = $request->input("addTime");
	    $accountCategoryId = $request->input("accountCategoryId");
	    $incomeExpendCategoryId = $request->input("incomeExpendCategoryId");
	    $remark = $request->input("remark");
        IncomeExpendRecordModel::insert([
            'user_id' => $this->userId,
            'money' => $money,
            'account_category_id' => $accountCategoryId,
            'income_expend_categoryId' => $incomeExpendCategoryId,
            'type' => $type,
            'add_time' => $addTime,
            'remark' => $remark,
        ]);
	    return MVCUtil::getResponseContent(self::RET_SUCC);
	}
	
	/**
	 * 修改支出记录
	 * 不可将支出和收入切换
	 */
	public function modifyRecord(Request $request)
	{
	    $recordId = $request->input("id");
	    $money = $request->input("money");
	    $addTime = $request->input("addTime");
	    $accountCategoryId = $request->input("accountCategoryId");
	    $incomeExpendCategoryId = $request->input("incomeExpendCategoryId");
	    $remark = $request->input("remark");
	    IncomeExpendRecordModel::where('id', $recordId)->where('user_id', $userId)->update([
            'money' => $money,
            'account_category_id' => $accountCategoryId,
            'income_expend_categoryId' => $incomeExpendCategoryId,
            'add_time' => $addTime,
            'remark' => $remark,
        ]);
	    return MVCUtil::getResponseContent(self::RET_SUCC);
	}
	
	public function removeRecord(Request $request)
	{
	    $recordId = $request->input("id");
	    $userId = Session::get('user_id');
	    //需要加上user_id，防止恶意删除其他用户的
	    IncomeExpendRecordModel::where('id', $recordId)->where('user_id', $userId)->delete();
	    return MVCUtil::getResponseContent(self::RET_SUCC);
	}
}