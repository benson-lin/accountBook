<?php
namespace App\Util;

class ToolUtil
{
	const KEY = '^$t^JwqDD1n7D^YL';
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

	public static function mcrypt($text){
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$cryptText = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::KEY, $text, MCRYPT_MODE_ECB, $iv)));
		return $cryptText;
	}
	
	public static function decrypt($cryptText){
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$data = mcrypt_decrypt(MCRYPT_RIJNDAEL_256,self::KEY,base64_decode($cryptText),MCRYPT_MODE_ECB,$iv);
		$text = str_replace("\0", "", $data);
		return $text;
	}
	
	
}