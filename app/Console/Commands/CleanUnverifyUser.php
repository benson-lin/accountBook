<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Util\ToolUtil;
use App\Enum\MapEnum;

class CleanUnverifyUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acountbook:cleanunverifyuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete unverified user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	//延迟30s删除无验证的用户，防止刚好用户点击链接了，但是user表已被删除
    	//如链接加密的时间的是2017-02-22 20:37:57，在接受邮件时校验时间是EXPIRE_MINUTES，即1天，2017-02-23 20:37:57
    	//过期后在2017-02-23 20:38:27时释放邮箱和昵称，
    	$date = ToolUtil::timetostr(strtotime('-'.MapEnum::EXPIRE_MINUTES.' minute -30 second', time()));
    	$sql =  "delete from t101_user where is_verify=0 and create_time<'".$date."'";
    	DB::delete($sql);
    }
}
