<?php

namespace App\Http\Controllers\IncomeExpend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncomeExpendRecordModel;
use App\Util\MVCUtil;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller {
	
	public function statistics()
	{
	    return response()->view('chart/chart-statistics');
	}
	
	//七天内的收支记录
	public function lineChart()
	{
		
		$dbRecords = DB::select("select substr(add_time, 1, 10) as add_time, type, sum(money) as money from t301_income_expend_record where user_id=1 and add_time between :addTimeBegin and :addTimeEnd group by substr(add_time, 1, 10), type", 
				["addTimeBegin"=>date("Y-m-d 00:00:00", strtotime("-6 day")), "addTimeEnd"=>date("Y-m-d 23:59:59", strtotime("0 day"))]);
		$records = [];
		for($i=0; $i<count($dbRecords); $i++){
			$record = get_object_vars($dbRecords[$i]);
			$addTime = $record['add_time'];
			$type = $record['type'];
			$records[$addTime][$type] = $record['money'];
		}
// 		var_dump($records);

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
		
// 		echo "<pre>";
// 		var_dump($records);
// 		echo "</pre>";
		return MVCUtil::getResponseContent(self::RET_SUCC, '', [
				'sevenDates'=>$sevenDates,
				'income'=>$income,
				'expend'=>$expend,
		]);
	}
}