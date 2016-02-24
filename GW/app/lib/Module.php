<?php

require_once 'app/lib/interface/ModuleInterface.php';
require_once 'app/App.php';

class Module extends App implements ModuleInterface
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
    public function redirect(string $path, $query = null)
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
