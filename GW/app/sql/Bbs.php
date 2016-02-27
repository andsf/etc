<?php
namespace app\sql;

use app\sql;
use app\App;

class Bbs extends App
{
    public function select($id = NULL){
        if(is_null($id)){
            $data = Dao::connect()->prepare("SELECT * FROM comment_table WHERE delete_flag = :flag");
        }else{
            $data = Dao::connect()->prepare("SELECT * FROM comment_table WHERE comment_id = :id AND delete_flag = :flag");
            $data->bindValue(':id', intval($id));
        }
        $data->bindValue(':flag', 0);
        $data->execute();
        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
    *@return bool
    */
    public function insert(array $params){
            $data = Dao::Connect()->prepare("INSERT INTO comment_table (title,comment,create_date) VALUES (:title, :comment, :create_date)");

            $data->bindValue(':title', $params['title']);
            $data->bindValue(':comment', $params['comment']);
            $data->bindValue(':create_date', date("y-m-d h:i:s"));
            if($data->execute()){
                return true;
            }else{
                return false;
            }
    }

    public function logicDelete($id){
        $data = Dao::Connect()->prepare("UPDATE comment_table SET delete_flag=:flag, update_date=:update_date WHERE comment_id = :id");

        $data->bindValue(':id', intval($id));
        $data->bindValue(':flag', 1);
        $data->bindValue(':update_date', date("y-m-d h:i:s"));
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $data = Dao::Connect()->prepare("DELETE FROM comment_table WHERE comment_id = :id");

        $data->bindValue(':id', intval($id));
        if($data->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function update(array $params){
        // try{
        //     Dao::Connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //     Dao::Connect()->beginTransaction();
        //
            $data = Dao::Connect()->prepare("UPDATE comment_table SET title=:title, comment=:comment, update_date=:update_date WHERE comment_id = :id");

            $data->bindValue(':title', $params['title']);
            $data->bindValue(':comment', $params['comment']);
            $data->bindValue(':id', $params['comment_id']);
            $data->bindValue(':update_date', date("y-m-d h:i:s"));
            if($data->execute()){
                return true;
            }else{
                return false;
            }

        //     Dao::Connect()->commit();
        //     return true;
        // }catch(Exception $e){
        //     Dao::Connect()->rollback();
        //     return false;
        // }
    }
}
