<?php
namespace App\Enum;
/**
 * 枚举基础类
 * @author tomjrwu
 */
abstract class EnumBase
{
    public static function getMap()
    {
        return static::$map;
    }

    public static function getKey($display)
    {
        if (!in_array($display, static::$map)) {
            throw new \Exception(get_called_class()."::getKey()参数有误!(display:{$display})");
        }

        foreach (static::$map as $k => $v) {
            if ($v == $display) {
                return $k;
            }
        }
    }

    public static function getDisplay($key)
    {
        $invalid = false;
        if (!is_numeric($key)) $invalid = true;
        $key = intval($key);
        if (!array_key_exists($key, static::$map)) $invalid = true;

        if ($invalid) {
            if (isset(static::$exception) && array_key_exists($key, static::$exception)) {
                return static::$exception[$key];
            }

            throw new \Exception(get_called_class()."::getDisplay()参数有误!(key:{$key})");
        }

        return static::$map[$key];
    }
}
