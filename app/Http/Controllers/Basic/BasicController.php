<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Util\MVCUtil;
use App\Models\UserModel;

class BasicController extends Controller {
	
    public function index()
    {
        return response()->view('index');
    }
    
	public function login(Request $request)
	{
		$nickname = $request->input('login-nickname');
		$password = $request->input('login-password');
		$user = UserModel::where('nickname', $nickname)->where('password', $password)
			->first();
		if(!empty($user)){
		    Session::set('user_id', $user['id']);
			Session::set('nickname', $nickname);
			Cookie::queue('nickname', $nickname);
			return redirect()->to('');
		}
		return response()->view('login');
	}
	
	
	
	public function logout(Request $request)
	{
		Session::forget('nickname');
		return redirect()->to('');
	}
	
	public function registerPage()
	{
		return response()->view('register');
	}
	public function register(Request $request)
	{
		$username = $request->input('register-username');
		$nickname = $request->input('register-nickname');
		$password = $request->input('register-password');
		$user = UserModel::where('nickname', $nickname)->get()->toArray();

		$code = 200;
		$message = '';
		if(!empty($user)){//用户已存在
			$code =501;
			$message = '用户名已存在';
		}else{
			UserModel::insert(['username'=>$username,'nickname'=>$nickname,'password'=>$password]);
			$result['code'] = 200;
		}
		return MVCUtil::getResponseContent($code, $message);
		
	}
	
	public function sendMail()
	{
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