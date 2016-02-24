<?php
// namespace app\model;

abstract class App
{
    private static $_ins;

    public static function ins()
    {
        if(empty(self::$_ins)){
            self::$_ins = new static();
        }
        return self::$_ins;
    }

}
