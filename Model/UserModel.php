<?php
/**
 * Created by PhpStorm.
 * User: anatolii
 * Date: 06.12.16
 * Time: 19:51
 */

namespace Model;

class UserModel extends BaseModel
{
    protected $table = 'users';

    public function getUser($login)
    {
        $result = $this->db->query("select * from " . $this->table . " WHERE login = '" . $login . "'");
        return $result[0];
    }

    public function checkLogin($login)
    {
        $result = $this->db->query("select COUNT(*) from " . $this->table . " WHERE login = '" . $login . "'");
        return $result[0]['COUNT(*)'];
    }

    public function addUser()
    {
        if (isset($_POST['getNewsR']))
            $_POST['getNewsR'] = 1;
        else
            $_POST['getNewsR'] = 0;
        $this->db->query("INSERT INTO `users`(`login`, `email`, `password`, `getnews`) VALUES ('" . $_POST['loginR']
            . "', '" . $_POST['emailR'] . "', '" . $_POST['password1R'] . "', " . $_POST['getNewsR'] . ")");
    }
}