<?php
namespace app\lib;

use app\App;
// use app\lib\package\ModuleInterface;

// class Module extends App implements ModuleInterface
class Module extends App
{
    /**
     * disp view
     * @param  string $path
     */
    public function display(string $path)
    {
        include($path);
        exit();
    }

    /**
     * run redirect
     * @param  string $path
     * @param  array $query [$key => $val,...] is ?$key=$val
     * @return obj
     */
    public function redirect(string $path, array $query = null)
    {
        if (!empty($query)) {
            foreach ($query as $num => $val) {
                $queryKey = key($val);
                $argument = ($num == 1) ? '?'.$queryKey : '&'.$queryKey;
                $path .= $argument.'='.$val[$queryKey];
            }
        }
        header('Location: '.$path);
        exit();
    }
}
