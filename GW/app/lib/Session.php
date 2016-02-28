<?php
namespace app\lib;

use app\App;

class Session extends App
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Check if targets has a session key.
     * @param  array   $targets ['session key', ...]
     * @return boolean
     */
    public function has(array $targets)
    {
        foreach ($targets as $sessionName) {
            if (isset($_SESSION[$sessionName])) {
                return false;
            }
        }
        return true;
    }

    /**
     * get session data
     */
    public function get($target)
    {
        return $_session[$target];
    }

    /**
     * add session data
     * @param array $targets [$sessionName => $addData] is $_session[$sessionName] = $addData.
     */
    public function add(array $targets)
    {
        foreach ($targets as $sessionName => $addData) {
            $_SESSION[$sessionName] = $addData;
        }
    }

    public function forget()
    {
    }
}
