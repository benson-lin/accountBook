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
		$key = '^$t^JwqDD1n7D^YL';
		$text = $email;		
		
		$cryptText = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv)));
		Session::set($email.'-email', $email);
		Session::set($email.'-nickname', $nickname);
		Session::set($email.'-password', $password);
		Session::save();
		$flag = Mail::send('mail.register', ['text'=> $cryptText],function($message) use($email){
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
		$key = '^$t^JwqDD1n7D^YL';
		$crypttext = $request->input('data');
		$email = mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,base64_decode($crypttext),MCRYPT_MODE_ECB,$iv);
		$email = str_replace("\0", "", $email);
		$sessionMail = $email.'-email';
		if(Session::has($sessionMail) && Session::get($sessionMail) == $email) {
			$nickname = Session::get($email.'-nickname');
			$password = Session::get($email.'-password');
			$user = UserModel::where('email', $email)->get()->toArray();
			if(!empty($user)){//用户已存在
				Session::forget($sessionMail);
				return response()->view('mail.register-fail',[
						'msg' => '邮箱已被注册'
				]);

			}else{
				UserModel::insert(['email'=>$email,'nickname'=>$nickname,'password'=>md5($password)]);
				Session::forget($sessionMail);
				return response()->view('mail.register-succ');
			}
			
		} else {
			return response()->view('mail.register-fail', [
					'msg' => '链接已失效'
			]);
		}
	}
	
	
	public function sendEmailSucc(){
		return response()->view('mail.send-succ');
	}
	
	
	public function registerSendEmail(Request $request)
	{
		$email = $request->input('email');
		$key = 'hHzN2tbmu*R4o2sq3KWn';
		$md5 = md5("{$key}");
		Session::set('registerInfo', $md5.'|||'.$email);
		$flag = Mail::send('mail.register', ['hash_string'=> $md5],function($message){
			$to = '1096101803@qq.com';
			$message ->to($to)->subject('账簿系统注册通知');
		});
			if($flag){
				echo '发送邮件成功，请查收！';
			}else{
				echo '发送邮件失败，请重试！';
			}
	}
	

}