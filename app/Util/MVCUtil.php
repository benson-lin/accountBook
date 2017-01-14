<?php
namespace App\Util;

class MVCUtil
{
	/**
	 * 生成响应内容
	 * @param int $code
	 * @param string $message
	 * @param array $data
	 */
	public static function getResponseContent($code, $message = '', $data = [])
	{
		$content = json_encode(['code' => $code, 'message' => $message, 'data' => $data], JSON_UNESCAPED_UNICODE);
		return $content;
	}
	
	
	
}