<?php

class Session
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * セッションキーを持っているか確認
     * @return boolean
     */
    public function has($targets)
    {
        if (isset($_SESSION[$targets])) {
            return true;
        }
        return false;
    }

    /**
     * セッションデータ取得
     */
    public function get($target)
    {
        return $_SESSION[$target];
    }

    /**
     * セッションにデータ追加
     * @param array $targets [$sessionName => $addData] is $_session[$sessionName] = $addData.
     */
    public function add(array $targets)
    {
        foreach ($targets as $sessionName => $addData) {
            $_SESSION[$sessionName] = $addData;
        }
    }

    /**
     * ログアウト処理
     */
    public function logout()
    {
        // セッション変数を全て解除する
        $_SESSION = [];
        //
        if (isset($_COOKIE["PHPSESSID"])) {
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }
        // 最終的に、セッションを破壊する
        session_destroy();
    }
}
