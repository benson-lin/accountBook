<?php
namespace App\Enum;
 
use App\Enum\EnumBase;

/**
 * 收入支出类型
 * @author bensonlin
 *
 */
class TypeEnum extends EnumBase
{
    /**
     * 收入
     */
    const INCOME = 1;
    
    /**
     * 支出
     */
    const EXPEND = 2;
    
    protected static $map = array(
        self::INCOME => '收入',
        self::EXPEND => '支出',
    );
}

?>