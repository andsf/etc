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
     * @param  array   $targets ['session key', ...]
     * @return boolean
     */
    public function has(array $targets)
    {
        foreach ($targets as $sessionName) {
            if (isset($_SESSION[$sessionName])) {
                return true;
            }
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
     * セッションデータ削除
     */
    public function forget()
    {
    }
}
