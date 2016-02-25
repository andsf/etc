<?php
namespace app\controller;

use app\model\Bbs;
use app\App;

class BbsController extends App
{
    public function index(){
        $ret = Bbs::ins()->select();
        include('app/view/bbs.php');
    }

    public function insert(){
        $params = $_POST;
        if(isset($params['title']) && isset($params['comment'])){
            $ret = Bbs::ins()->insert($params);
            header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
            exit();
        }
        include('app/view/insert.php');
    }

    public function logicDelete($query){
        if(isset($query)){
            Bbs::ins()->logicDelete($query);
        }
        header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
        exit();
    }

    public function delete($query){
        if(isset($query)){
            Bbs::ins()->delete($query);
        }
        header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
        exit();
    }

    public function update($query){
        $date = $_POST;
        if(isset($query) && empty($date)){
            $ret = array_pop(Bbs::ins()->select($query));
            include('app/view/update.php');
            exit();
        }else{
            Bbs::ins()->update($date);
            header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
            exit();
        }

    }

}
