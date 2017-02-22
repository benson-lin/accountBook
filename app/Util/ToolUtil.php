<?php
namespace App\Util;

class ToolUtil
{
	/**
	 * std对象转数组
	 */
	public static function stdToArray($obj)
	{
	    $reaged = (array)$obj;
	    foreach($reaged as $key => &$field){
	      if(is_object($field)
	      		)$field = stdToArray($field);
	    }
		return $reaged;
	}
	
	public static function timetostr($timestamp)
	{
		if (!is_int($timestamp)) {
			throw new \Exception('timetostr()参数有误');
		}
	
		return date('Y-m-d H:i:s', $timestamp);
	}
	
}