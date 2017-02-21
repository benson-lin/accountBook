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
		$user = UserModel::where('nickname', $nickname)->where('password', md5($password))
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
		
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$text = $email;		
		
		$cryptText = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::KEY, $text, MCRYPT_MODE_ECB, $iv)));
		Session::set($email.'-email', $email);
		Session::set($email.'-nickname', $nickname);
		Session::set($email.'-password', $password);
		Session::save();
		$flag = Mail::send('basic.mail', ['text'=> $cryptText],function($message) use($email){
			$to = $email;
			$message ->to($to)->subject('账簿系统注册通知');
		});
		if($flag){
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
		$email = mcrypt_decrypt(MCRYPT_RIJNDAEL_256,self::KEY,base64_decode($crypttext),MCRYPT_MODE_ECB,$iv);
		$email = str_replace("\0", "", $email);
		$sessionMail = $email.'-email';
		if(Session::has($sessionMail) && Session::get($sessionMail) == $email) {
			$nickname = Session::get($email.'-nickname');
			$password = Session::get($email.'-password');
			$user = UserModel::where('email', $email)->get()->toArray();
			if(!empty($user)){//用户已存在
				Session::forget($sessionMail);
				return response()->view('basic.register-fail',[
						'msg' => '邮箱已被注册'
				]);

			}else{
				UserModel::insert(['email'=>$email,'nickname'=>$nickname,'password'=>md5($password)]);
				Session::forget($sessionMail);
				return response()->view('basic.register-succ');
			}
			
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