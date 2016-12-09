<?php
/**
 * Created by PhpStorm.
 * User: anatolii
 * Date: 07.12.16
 * Time: 1:02
 */

namespace Model;


class CommentsModel extends BaseModel
{
    protected $table = 'comments';

    public function getComments($article = 0, $isModerated = 0)
    {
        if ($article && !$isModerated) {
            $result = $this->db->query("select * from " . $this->table . " WHERE articleID = '" . $article
                . "' AND answerto = '0' ORDER BY rate DESC");
            for ($i = 0; isset($result[$i]); $i++) {
                $result[$i]['subcomments'] = $this->db->query("select * from " . $this->table . " WHERE articleID = '"
                    . $article . "' AND answerto = '" . $result[$i]['id'] . "' ORDER BY time");
            }
        }
        if (!$article && $isModerated)
            $result = $this->db->query("select * from " . $this->table . " where `moderated` = 0");
        return $result;
    }

    public function changeRate($id, $rate)
    {
        $this->db->query("UPDATE " . $this->table . " SET `rate` = `rate` + " . $rate . " WHERE id =" . $id);
        $rate = $this->db->query("SELECT `rate` FROM " . $this->table . " WHERE id =" . $id);
        return $rate;
    }

    public function addComment($answerto, $content, $articleID, $moderated)
    {
        $query = "INSERT INTO " . $this->table . "(`author`, `answerto`, `content`, `articleID`, `moderated`) VALUES ('";
        $query .= $_SESSION['user'] . "', " . $answerto . ", '" . $content . "', " . $articleID . ", " . $moderated . ")";
        $this->db->query($query);
    }

    public function modifyComment($content, $id)
    {
        $query = "UPDATE " . $this->table . " SET `content`= '" . $content . "' WHERE id = " . $id;
        $this->db->query($query);
    }

    public function allow($id){
        $query = "UPDATE " . $this->table . " SET `moderated`= '1' WHERE id = " . $id;
        $this->db->query($query);
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id = " . $id;
        $this->db->query($query);
    }
}