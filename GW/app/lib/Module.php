<?php
namespace app\lib;

use app\App;

class Module extends App
{
    private $session;
    private $redirectPath;

    public function __construct()
    {
        $this->session = Session::ins();
    }

    /**
     * disp view
     * @param  string $path
     * @param  array $args [$key => $val,...]
     */
    public function view($path, array $args = null)
    {
        if (!empty($args)) {
            foreach ($args as $arg => $data) {
                ${$arg} = $data;
            }
        }
        include($path);
    }

    /**
     * run redirect
     * @param  string $path
     * @return obj
     */
    public function redirect($path)
    {
        $this->redirectPath = $path;
        return $this;
    }

    /**
     * redirect parts
     * when $args is null, no session
     *
     * @param  array $args [$key => $val,...] is $key=$val in session
     */
    public function with(array $args = null)
    {
        if (empty($args)) {
            $this->runRedirect($this->redirectPath);
        }
        $array = [];
        foreach ($args as $key => $val) {
            $array = [$key => $val];
        }
        $this->session->add($array);
        $this->runRedirect($this->redirectPath);
    }

    /**
     * redirect parts
     * @param  array $query [$key => $val,...] is ?$key=$val
     */
    public function query($query)
    {
        if (!empty($query)) {
            foreach ($query as $num => $val) {
                $queryKey = key($val);
                $argument = ($num == 1) ? '?'.$queryKey : '&'.$queryKey;
                $this->redirectPath .= $argument.'='.$val[$queryKey];
            }
        }
        $this->runRedirect($this->redirectPath);
    }

    private function runRedirect($path)
    {
        return header('Location: '.$path);
    }
}
