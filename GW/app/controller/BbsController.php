<?php
// namespace app\controller;
//
// use app\model\Bbs;

require_once 'app/model/Bbs.php';

class BbsController
{
    public function index(){
        $db = new Bbs();
        $ret = $db->select();
        include('app/view/bbs.php');
    }

    public function insert(){
        $params = $_POST;
        if(isset($params['title']) && isset($params['comment'])){
            $db = new Bbs();
            $ret = $db->insert($params);
            header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
            exit();
        }
        include('app/view/insert.php');
    }

    public function logicDelete($query){
        if(isset($query)){
            $db = new Bbs();
            $db->logicDelete($query);
        }
        header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
        exit();
    }

    public function delete($query){
        if(isset($query)){
            $db = new Bbs();
            $db->delete($query);
        }
        header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
        exit();
    }

    public function update($query){
        $date   = $_POST;
        if(isset($query) && empty($date)){
            $db = new Bbs();
            $ret = array_pop($db->select($query));
            include('app/view/update.php');
            exit();
        }else{
            $db = new Bbs();
            $db->update($date);
            header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
            exit();
        }

    }

    public function allDelete($params = null)
    {
       $db = new Bbs();
       if (!empty($params)) {
          $db->deleteArticle($params);
       } else {
         $db->deleteArticle()
       }
}
