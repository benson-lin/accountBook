<?php

namespace App\Http\Controllers\IncomeExpend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncomeExpendRecordModel;
use App\Util\MVCUtil;
use Illuminate\Support\Facades\DB;
use App\Models\AccountCategoryModel;

class ChartController extends Controller {
	
	public function statistics()
	{
	    return response()->view('chart/chart-statistics');
	}
	
	
	public function getRemainMoneyByAccount()
	{
		$records = DB::select("select ca.name, 
				sum(case when type=1 then money else (-1)*money end) as money
				from t301_income_expend_record re join t201_account_category ca on re.account_category_id =  ca.id 
				where user_id=:userId group by account_category_id", ["userId"=>$this->userId]);
		return MVCUtil::getResponseContent(self::RET_SUCC, '', $records);
	}
	
	//七天内的收支记录
	public function lineChart()
	{
		$dbRecords = DB::select("select substr(add_time, 1, 10) as add_time, type, sum(money) as money from t301_income_expend_record where user_id=:userId and add_time between :addTimeBegin and :addTimeEnd group by substr(add_time, 1, 10), type", 
				["userId"=>$this->userId, "addTimeBegin"=>date("Y-m-d 00:00:00", strtotime("-6 day")), "addTimeEnd"=>date("Y-m-d 23:59:59", strtotime("0 day"))]);
		$records = [];
		for($i=0; $i<count($dbRecords); $i++){
			$record = get_object_vars($dbRecords[$i]);
			$addTime = $record['add_time'];
			$type = $record['type'];
			$records[$addTime][$type] = $record['money'];
		}
		$sevenDates = [];//["2017-01-22", "2017-01-23", "2017-01-24", "2017-01-25", "2017-01-26", "2017-01-27", "2017-01-28"]
		$tempUnixTime = time();
		for ($i=0; $i<7; $i++) {
			array_unshift($sevenDates, date("Y-m-d", $tempUnixTime));
			$tempUnixTime = $tempUnixTime-86400;
		}
		
		for($i=0; $i<count($sevenDates); $i++){
			$oneDate = $sevenDates[$i];
			if(!isset($records[$oneDate][1])){
				$records[$oneDate][1] = 0;
			}
			if(!isset($records[$oneDate][2])){
				$records[$oneDate][2] = 0;
			}
		}
		$income = [];
		$expend = [];
		for($i=0; $i<count($sevenDates); $i++){
			$oneDate = $sevenDates[$i];
			$income[] = $records[$oneDate][1];
			$expend[] = $records[$oneDate][2];
		}
		
		return MVCUtil::getResponseContent(self::RET_SUCC, '', [
				'sevenDates'=>$sevenDates,
				'income'=>$income,
				'expend'=>$expend,
		]);
	}
	
	//近一个月收入支出比例
	public function barChart() {
		$incomeRecords = IncomeExpendRecordModel::select('income_expend_category_id', DB::RAW('sum(money) as money'))
			->where('user_id', $this->userId)->where('type', 1)->whereBetween('add_time', [date("Y-m-d 00:00:00", strtotime("-30 day")), date("Y-m-d 00:00:00", strtotime("0 day"))])
			->with('incomeExpend')->groupBy('income_expend_category_id')->get()->toArray();
		$incomeR = [];
		$incomeAccountNames = [];
// 		print_r($incomeRecords);
// 		return;
		foreach ($incomeRecords as $r) {
			$name = $r['income_expend']['name'];
			$incomeAccountNames[] = $name;
			$value = $r['money'];
			$oneR = ['name'=>$name, 'value'=>$value];
			$incomeR[] = $oneR;
		}
		
		
		$expendRecords = IncomeExpendRecordModel::select('income_expend_category_id', DB::RAW('sum(money) as money'))
			->where('user_id', $this->userId)->where('type', 2)->whereBetween('add_time', [date("Y-m-d 00:00:00", strtotime("-30 day")), date("Y-m-d 00:00:00", strtotime("0 day"))])
			->with('incomeExpend')->groupBy('income_expend_category_id')->get()->toArray();
		$expendR = [];
		$expendAccountNames = [];
		foreach ($expendRecords as $r) {
			$name = $r['income_expend']['name'];
			$expendAccountNames[] = $name;
			$value = $r['money'];
			$oneR = ['name'=>$name, 'value'=>$value];
			$expendR[] = $oneR;
		}
		return MVCUtil::getResponseContent(self::RET_SUCC, '', [
				'incomeRecords'=>$incomeR,
				'incomeAccountNames' => $incomeAccountNames,
				'expendRecords'=>$expendR,
				'expendAccountNames' => $expendAccountNames,
		]);
	}
	
	
	//近一个月收入支出比例：按账号分类
// 	public function barChart() {
// 		$incomeRecords = IncomeExpendRecordModel::select('account_category_id', DB::RAW('sum(money) as money'))
// 		->where('user_id', $this->userId)->where('type', 1)->whereBetween('add_time', [date("Y-m-d 00:00:00", strtotime("-30 day")), date("Y-m-d 00:00:00", strtotime("0 day"))])
// 		->with('account')->groupBy('account_category_id')->get()->toArray();
// 		$incomeR = [];
// 		$incomeAccountNames = [];
// 		foreach ($incomeRecords as $r) {
// 			$name = $r['account']['name'];
// 			$incomeAccountNames[] = $name;
// 			$value = $r['money'];
// 			$oneR = ['name'=>$name, 'value'=>$value];
// 			$incomeR[] = $oneR;
// 		}
	
	
// 		$expendRecords = IncomeExpendRecordModel::select('account_category_id', DB::RAW('sum(money) as money'))
// 		->where('user_id', $this->userId)->where('type', 2)->whereBetween('add_time', [date("Y-m-d 00:00:00", strtotime("-30 day")), date("Y-m-d 00:00:00", strtotime("0 day"))])
// 		->with('account')->groupBy('account_category_id')->get()->toArray();
// 		$expendR = [];
// 		$expendAccountNames = [];
// 		foreach ($expendRecords as $r) {
// 			$name = $r['account']['name'];
// 			$expendAccountNames[] = $name;
// 			$value = $r['money'];
// 			$oneR = ['name'=>$name, 'value'=>$value];
// 			$expendR[] = $oneR;
// 		}
// 		return MVCUtil::getResponseContent(self::RET_SUCC, '', [
// 				'incomeRecords'=>$incomeR,
// 				'incomeAccountNames' => $incomeAccountNames,
// 				'expendRecords'=>$expendR,
// 				'expendAccountNames' => $expendAccountNames,
// 		]);
// 	}
}