<?php
namespace app;

abstract class App
{
    public static function ins()
    {
        return new static();
    }
}
