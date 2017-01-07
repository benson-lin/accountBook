<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Closure;

class CheckLogin
{
	
	public function handle($request, Closure $next)
	{
		if ($this->isLogin()) {
			return $next($request);
		}else{
			return response()->view('login');
		}

	}
	
	private function isLogin()
	{
		return Session::has('nickname')
			&& Session::get('nickname') == Cookie::get('nickname');
	}
}
