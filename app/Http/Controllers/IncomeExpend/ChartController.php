<?php

namespace App\Http\Controllers\IncomeExpend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller {
	
	public function statistics()
	{
	    return response()->view('chart-statistics');
	}
}