<?php

class Sql
{
    const DELETE_FLAG_ON = 1;
    const DELETE_FLAG_OFF = 0;

    public function connection()
    {
        try {
            $pdo = new \PDO('mysql:host=localhost; dbname=kadai; charset=utf8','root','root');
        } catch(PDOException $e) {
            exit('データベース接続失敗'.$e->getMessage());
        }
        return $pdo;
    }

    /**
     * ログイン確認用sql
     */
    public function checkLogin($mail, $pass)
    {
        $sql = 'select u.id as id, u.mail_address as mail_address, l.password as password from user as u
                    inner join login as l
                    on u.id = l.user_id
                    where
                    u.mail_address = :mail
                    and
                    l.password = :pass';
        $data = $this->connection()->prepare($sql);
        $data->bindValue(':mail', $mail);
        $data->bindValue(':pass', $pass);
        $data->execute();
        return $data->fetchAll(\PDO::FETCH_ASSOC)[0];
    }

    /**
     * 掲示板データ取得
     */
    public function getBbsData()
    {
        $sql = 'select e.id as eid, e.title, e.text, e.file_path, e.created_at, u.user_name, u.id as uid
                    from entry as e
                    inner join user as u
                    on e.user_id = u.id
                    where e.deleted_flag = :flag';
        $data = $this->connection()->prepare($sql);
        $data->bindValue(':flag', self::DELETE_FLAG_OFF);
        $data->execute();
        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 掲示板新規投稿
     */
    public function insert($id, $title, $text)
    {
        $sql = 'insert into entry (user_id, title, text, created_at) values (:id, :title, :text, :created_at)';
        $data = $this->connection()->prepare($sql);
        $data->bindValue(':id', $id);
        $data->bindValue(':title', $title);
        $data->bindValue(':text', $text);
        $data->bindValue(':created_at', date("Y-m-d H:i:s"));
        return $data->execute();
    }

    /**
     * 個別の投稿内容を取得する
     */
    public function getBbsDataByEntryId($entryId)
    {
        $sql = 'select * from entry where id = :entryId deleted_flag = :flag';
        $data = $this->connection()->prepare($sql);
        $data->bindValue(':entryId', $entryId);
        $data->bindValue(':flag', self::DELETE_FLAG_OFF);
        $data->execute();
        return $data->fetchAll(\PDO::FETCH_ASSOC)[0];
    }

    /**
     * 投稿内容を編集する
     */
    public function update($eid, $title, $text)
    {
        $sql = 'update entry set title = :title, text = :text where id = :eid';
        $data = $this->connection()->prepare($sql);
        $data->bindValue(':title', $title);
        $data->bindValue(':text', $text);
        $data->bindValue(':eid', $eid);
        return $data->execute();
    }

    /**
     * 投稿内容を削除する（論理削除）
     */
    public function delete($eid)
    {
        $sql = 'update entry set deleted_flag = :flag where id = :eid';
        $data = $this->connection()->prepare($sql);
        $data->bindValue(':flag', self::DELETE_FLAG_ON);
        $data->bindValue(':eid', $eid);
        return $data->execute();
    }
}
