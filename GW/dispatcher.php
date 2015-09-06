<?php

class dispatcher
{
    const SEARCH_STRING = '/doc/test/GW/app/';
    const SYSROOT_CONTROLLER = 'app/controller/';
    const DEFAULT_CLASS = 'Bbs';
    const DEFAULT_ACTION = 'index';

    /**
     * request dispache
     * @return
     */
    public function Dispatch($path)
    {
        // /Bbs/insert
        $requestUrl = str_replace(self::SEARCH_STRING,'/',$path);

        if($requestUrl === '/' || strlen($requestUrl) !== 1){
            $class  = self::DEFAULT_CLASS;
            $action = self::DEFAULT_ACTION;
        }else{
            $params = explode('/', $requestUrl);

            $class  = $params[1];
            $action = $params[2];

            if(!empty($params[3])){
                $query  = $params[3];
            }
        }

        $className  = $class.'Controller';

        require_once self::SYSROOT_CONTROLLER.$className.'.php';

        $Ins = new $className();

        if (!empty($query)) {
            $Ins->$action($query);
        }
        $Ins->$action();
    }
}
