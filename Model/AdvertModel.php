<?php
/**
 * Created by PhpStorm.
 * User: anatolii
 * Date: 08.12.16
 * Time: 3:31
 */

namespace Model;


class AdvertModel extends BaseModel
{
    protected $table = 'advert';

    public function getAdvert(){
        $result = $this->db->query("SELECT * FROM " . $this->table . " ORDER BY id DESC LIMIT 8");
        return $result;
    }

    public function addAdvert(){
        $query = "INSERT INTO `advert`(`price`, `goods`, `seller`, `image`) VALUES ( " . $_POST['Adprice'] . ", \""
            . $_POST['Adgoods'] . "\", \"" . $_POST['Adseller'] . "\", \"" . $_POST['Adimage'] . "\")";
        $this->db->query($query);
    }
}