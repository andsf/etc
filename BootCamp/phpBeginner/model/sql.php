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
        $sql = 'select * from entry as e
                    inner join user as u
                    on e.user_id = u.id';
        $data = $this->connection()->prepare($sql);
        $data->execute();
        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }
}
