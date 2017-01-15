<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
        /**
     * 成功返回码
     * @var int
     */
    const RET_SUCC = 0;

    /**
     * 失败返回码
     * @var int
     */
    const RET_FAIL = -1;

    /** 每页默认显示数量 */
    const LIMIT_DEFAULT = 10;
    protected $userId = '';
    
    
    public function __construct()
    {
        $this->userId = Session::get('user_id');
    }
    
    
}
