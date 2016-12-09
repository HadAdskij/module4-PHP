<?php
/**
 * Created by PhpStorm.
 * User: anatolii
 * Date: 05.12.16
 * Time: 16:14
 */

namespace Model;


class ArticleModel extends BaseModel
{
    protected $table = 'article';

    public function getLast($number, $category = 0)
    {
        if ($category)
            $result = $this->db->query('select * from ' . $this->table . ' WHERE `hide` = 0 AND `category` = \'' . $category .
                '\' ORDER BY `add_time` DESC LIMIT ' . $number);
        else
            $result = $this->db->query('select * from ' . $this->table . ' ORDER BY `add_time` DESC LIMIT ' . $number);
        return $result;
    }

    public function getHot()
    {
        $result = array();
        $hot = $this->db->query("SELECT articleID, COUNT(*) AS alias FROM `comments` WHERE `hide` = 0 AND `time` >= DATE_SUB(NOW(),"
            ." INTERVAL 1 DAY) GROUP BY articleID ORDER BY alias DESC LIMIT 3");
        if ($hot)
            foreach ($hot as $i) {
                $temp = $this->db->query('select * from ' . $this->table . ' WHERE id=' . $i['articleID']);
                $result[] = $temp[0];
            }
        return $result;
    }

    public function getCategoryList()
    {
        $result = $this->db->query('select category from ' . $this->table . ' GROUP BY category');
        return $result;
    }

    public function search(&$parameters, &$number)
    {
        $query = "from  $this->table ";
        $parameters = explode('@', $parameters);
        if ($parameters[1] || $parameters[2] || $parameters[3] || $parameters[4] || $parameters[5])
            $query .= " WHERE `hide` = 0";
        if ($parameters[1]) {
            $query .= " AND ";
            $query = $query . "`category` = \"" . $parameters[1] . "\"";
        }
        if ($parameters[2]) {
            $query .= " AND ";
            $query = $query . "`tags` LIKE '%" . $parameters[2] . "%'";
        }
        if ($parameters[3]) {
            $query .= " AND ";
            $query = $query . "`add_time` > '" . $parameters[3] . "'";
        }
        if ($parameters[4]) {
            $query .= " AND ";
            $query = $query . "`add_time` < '" . $parameters[4] . "'";
        }
        if ($parameters[5]) {
            $query .= " AND ";
            $query = $query . "`analitics` = '1'";
        }

        $number = "select count(*) " . $query;
        $number = $this->db->query($number);
        $number = $number[0]["count(*)"];
        $query = "select * ". $query . " ORDER BY `add_time` DESC LIMIT 5";
        if ($parameters[0])
            $query = $query . " OFFSET " . $parameters[0];
        $result = $this->db->query($query);
        return $result;
    }

    public function getReaders($id, $current)
    {
        $this->db->query("UPDATE " . $this->table . " SET readers = readers + " . $current . " WHERE id = " . $id);
        $result = $this->db->query("select readers from " . $this->table . " WHERE id = " . $id);
        return $result[0]['readers'];
    }

    public function getTags($request){
        $tempResult = $this->db->query('select tags from ' . $this->table . ' where 1');
        $result = array();
        foreach ($tempResult as $i)
        {
            $temp = explode('#', $i['tags']);

            foreach ($temp as $j)
                if ($j && !in_array($j, $result) && mb_strstr($j, $request))
                    $result[] = $j;
        }
        return($result);
    }

    public function addNew(){
        $query = "INSERT INTO " . $this->table ." (`title`, `analitics`, `category`, `content`, `image`, `images`, `source`, `tags`) VALUES ('"
            . addcslashes($_POST['Atitle'], "\"") . "', ";
        if (isset($_POST['Aanalitics']))
            $query .= '1, \'';
        else
            $query .= '0, \'';
        $query .= $_POST['Acategory'] . "', '" . addcslashes($_POST['Acontent'], "\"") . "', '" . $_POST['Aimage'] . "', '" . $_POST['Aimages'] . "', '" . $_POST['Asource'] . "', '" . $_POST['Atags'] ."')";
        $this->db->query($query);
    }

    public function modify($id){
        $query = "UPDATE " . $this->table . " SET `title`=\"" . addcslashes($_POST['Atitle'], "\"") . "\", `analitics`=";
        if (isset($_POST['Aanalitics']))
            $query .= '1, ';
        else
            $query .= '0, ';
        if (isset($_POST['Ahide']))
            $query .= ' `hide` = 1,';
        $query .= "`category`='" . $_POST['Acategory'] . "',`content`=\"" . addcslashes($_POST['Acontent'], "\"") . "\",`image`=\"" . $_POST['Aimage']
            . "\",`images`=\"" . $_POST['Aimages'] . "\",`source`=\"" . $_POST['Asource'] . "\",`tags`='" . $_POST['Atags'] . "' WHERE id = " . $id;
        $this->db->query($query);
    }

    public function addCategory($name){
        $query = "INSERT into " . $this->table . " (`title`, `category`, `hide`) VALUES ('new category', '" . $name . "', 1)";
        $this->db->query($query);
    }


}