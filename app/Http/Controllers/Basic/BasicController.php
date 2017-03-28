<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Util\MVCUtil;
use App\Models\UserModel;
use Illuminate\Support\Facades\Mail;
use App\Enum\MapEnum;
use App\Util\ToolUtil;

class BasicController extends Controller {
	

	
    public function index()
    {
        return response()->view('index');
    }
    
	public function login(Request $request)
	{
		$nickname = $request->input('login-nickname');
		$password = $request->input('login-password');
		$user = UserModel::where('is_verify', 1)->where('password', md5($password))
				->where(function($query) use ($nickname){
					$query->where('nickname', $nickname)->orWhere('email', $nickname);
				})->first();
		if(!empty($user)){
		    Session::set('user_id', $user['id']);
			Session::set('nickname', $user['nickname']);
			Cookie::queue('nickname', $user['nickname']);
			return MVCUtil::getResponseContent(self::RET_SUCC);
		}
		return MVCUtil::getResponseContent(self::RET_FAIL, '用户名或密码错误');
	}
	
	
	
	public function logout(Request $request)
	{
		Session::forget('nickname');
		return redirect()->to('');
	}
	
	public function register(Request $request)
	{
		$email = $request->input('register-email');
		$nickname = $request->input('register-nickname');
		$password = $request->input('register-password');
		if (empty($email) || empty($nickname) || empty($password)) {
			return MVCUtil::getResponseContent(self::RET_FAIL, '存在空值');
		}
		
		$user = UserModel::where('email', $email)->orWhere('nickname', $nickname)->get()->toArray();
		if(!empty($user)){//用户已存在
			return MVCUtil::getResponseContent(self::RET_FAIL, '邮箱或昵称已存在');
		}
		
		$time = time();
		$text = $email.'&'.md5($email).'&'.$time;		
		
		$cryptText = ToolUtil::mcrypt($text, self::KEY);
		
		$flag = ToolUtil::sendEmail($email, '账簿系统注册通知', 'basic.mail', ['text'=> $cryptText, 'nickname'=>$nickname]);
		if($flag){
			UserModel::insert(['email'=>$email,'nickname'=>$nickname,'password'=>md5($password),'is_verify'=>0,
					'create_time' => date('Y-m-d H:i:s', $time)]);
			return MVCUtil::getResponseContent(self::RET_SUCC);
		}else{
			return MVCUtil::getResponseContent(self::RET_FAIL, '邮件发送失败，请重试');
		}
	}
	
	public function registerAccept(Request $request)
	{
		$cryptText = $request->input('data');
		$data = ToolUtil::decrypt($cryptText, self::KEY);
		
		try {
			//如果解析失败说明链接有问题，直接提示失败
			$result = explode('&',$data);
			$email = $result[0];
			$emailMD5 = $result[1];
			$time = $result[2];
		} catch (\Exception $e) {
			return response()->view('basic.register-fail', [
					'msg' => '链接已失效'
			]);
		}
		
		$expireTime = strtotime('+'.MapEnum::EXPIRE_MINUTES.' minute',$time);
		$now = time();
		if ($now > $expireTime) {//已过期
			return response()->view('basic.register-fail', [
					'msg' => '链接已失效'
			]);
		}
		if (md5($email) == $emailMD5) {
			UserModel::where('email', $email)->update(['is_verify' => 1]);
			return response()->view('basic.register-succ');
		} else {
			return response()->view('basic.register-fail', [
					'msg' => '链接已失效'
			]);
		}
	}
	
	
	public function sendEmailSucc()
	{
		return response()->view('basic.send-succ');
	}
	
	public function forgotPassword()
	{
		
	}
	

}