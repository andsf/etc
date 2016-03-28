<?php

class Cookie
{
    /**
     * クッキーがあるか確認
     */
    public function has($target)
    {
        if (isset($_COOKIE[$target])) {
            return true;
        }
        return false;
    }

    /**
     * クッキーを取得する
     */
    public function get($target)
    {
        return $_COOKIE[$target];
    }

    /**
     * ログイン用のクッキーとセットする
     */
    public function setLoginCookie($target)
    {
        setcookie('loginUser', $target);
    }

    /**
     * ログインクッキーを削除する
     */
    public function rmLoginCookie()
    {
        if (isset($_COOKIE['loginUser'])) {
            setcookie('loginUser');
        }
    }
}
