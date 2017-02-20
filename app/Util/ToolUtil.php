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
}