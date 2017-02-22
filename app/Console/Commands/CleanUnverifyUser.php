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
    	$date = ToolUtil::timetostr(strtotime('-'.MapEnum::EXPIRE_MINUTES.' minute', time()));
    	$sql =  "delete from t101_user where is_verify=0 and create_time<'".$date."'";
    	DB::delete($sql);
    }
}
