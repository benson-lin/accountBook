<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Basic\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class BasicController extends Controller {
	
	public function login(Request $request)
	{
		$username = $request->input('username');
		$password = $request->input('password');
		$user = User::where('nickname', $username)->where('password', $password)
			->get()->toArray();
		if(!empty($user)){
			Session::set('nickname', $username);
			Cookie::queue('nickname', $username);
			return redirect()->to('');
		}
		return response()->view('login');
	}
	
// 	public function export(){
// 		$cellData = [
// 			['学号','科目','成绩'],
// 			['10001','AAAAA','99'],
// 			['10002','BBBBB','92'],
// 			['10003','CCCCC','95'],
// 			['10004','DDDDD','89'],
// 			['10005','EEEEE','96'],
// 		];
// 		Excel::create('成绩',function($excel) use ($cellData){
// 			$excel->sheet('score', function($sheet) use ($cellData){
// 				$sheet->rows($cellData);
// 			});
// 		})->export('xls');
// 	}
}