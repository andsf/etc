<?php
namespace app\model;

class Dao
{
    private static $_instance;

    private function __construct(){}

    public static function connect()
    {
        return self::getInstance()->connection();
    }

    private function connection()
    {
        try{
            $pdo = new \PDO('mysql:host=localhost; dbname=kadai; charset=utf8','root','root');
        }catch(PDOException $e){
            exit('データベース接続失敗'.$e->getMessage());
        }
        return $pdo;
    }

    /**
    *this method is created self instance
    */
    private static function getInstance()
    {
        if(empty(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
