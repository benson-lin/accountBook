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

class BasicController extends Controller {
	
	const KEY = '^$t^JwqDD1n7D^YL';
	
    public function index()
    {
        return response()->view('index');
    }
    
	public function login(Request $request)
	{
		$nickname = $request->input('login-nickname');
		$password = $request->input('login-password');
		$user = UserModel::where('is_verify', 1)->where('nickname', $nickname)->where('password', md5($password))
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
		
		
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$text = $email.'&'.md5($email).'&'.time();		
		
		$cryptText = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::KEY, $text, MCRYPT_MODE_ECB, $iv)));
		
		$flag = Mail::send('basic.mail', ['text'=> $cryptText],function($message) use($email){
			$to = $email;
			$message ->to($to)->subject('账簿系统注册通知');
		});
		if($flag){
			UserModel::insert(['email'=>$email,'nickname'=>$nickname,'password'=>md5($password),'is_verify'=>0]);
			return MVCUtil::getResponseContent(self::RET_SUCC);
		}else{
			return MVCUtil::getResponseContent(self::RET_FAIL, '邮件发送失败，请重试');
		}
	}
	
	public function registerAccept(Request $request)
	{
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$crypttext = $request->input('data');
		$data = mcrypt_decrypt(MCRYPT_RIJNDAEL_256,self::KEY,base64_decode($crypttext),MCRYPT_MODE_ECB,$iv);
		$data = str_replace("\0", "", $data);
		$result = explode('&',$data); 
		$email = $result[0];
		$emailMD5 = $result[1];
		$time = $result[2];
		
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
	
	
	public function sendEmailSucc(){
		return response()->view('basic.send-succ');
	}
	
	

}