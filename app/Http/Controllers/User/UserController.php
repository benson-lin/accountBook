<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Util\MVCUtil;
use App\Models\UserModel;

class UserController extends Controller {
	
    public function getUserInfo()
    {
        $user = UserModel::where('nickname', $this->nickname)->first();
        return MVCUtil::getResponseContent(self::RET_SUCC, '', $user);
    }
   
}