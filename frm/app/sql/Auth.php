<?php
namespace app\sql;

use app\App;

class Auth extends App
{
    const DELETE_FLAG_ON = 1;
    const DELETE_FLAG_OFF = 0;

    /**
     * login
     * @param  string $mailaddress
     * @param  int $password
     * @return array
     */
    public function login($mail, $pass)
    {
        $sql = 'select * from user as u
                    inner join login as l
                    on u.id = l.user_id
                    where
                    u.mail_address = :mail
                    and
                    l.password = :pass,';
        $data = Dao::connect()->prepare($sql);
        $data->bindValue(':mail', $mail);
        $data->bindValue(':pass', $pass);
        $data->execute();
        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }
}
