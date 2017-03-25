<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Util\MVCUtil;
use Illuminate\Support\Facades\Session;
use App\Models\UserModel;

class UserController extends Controller {
	
	public function infoPage()
	{
		return response()->view('user/info');
	}
	
    public function getUserInfo()
    {
        $user = UserModel::where('nickname', $this->nickname)->first();
        return MVCUtil::getResponseContent(self::RET_SUCC, '', $user);
    }
   
    public function modifyNickname(Request $request)
    {
    	$newNickname = $request->input("newNickname");
    	$user = UserModel::where('nickname', $newNickname)->first();
    	if (!empty($user)) {
    		return  MVCUtil::getResponseContent(self::RET_FAIL, '昵称已存在，请重新更改昵称');
    	}
    	UserModel::where('nickname', $this->nickname)->update(['nickname'=>$newNickname]);
    	Session::forget('nickname');
    	return  MVCUtil::getResponseContent(self::RET_SUCC);
    	
    }
}