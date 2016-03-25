<?php

class Cookie
{
    public function has($target)
    {
        if (isset($_COOKIE[$target])) {
            return true;
        }
        return false;
    }

    public function get($target)
    {
        return $_COOKIE[$target];
    }

    public function setLoginCookie($target)
    {
        setcookie('loginUser', $target);
    }

    public function forget()
    {

    }
}
