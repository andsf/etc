<?php
namespace app\service;

use app\App;
use app\sql\Auth;

class AuthService extends App
{
    private $auth

    public function __construct()
    {
        $this->auth = Auth::ins();
    }

    public function login($mail, $pass)
    {
        if (empty($this->auth->login($mail, $pass))) {
            return false;
        }
        //TODO session処理
        return true;
    }
}
