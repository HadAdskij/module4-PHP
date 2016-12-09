<?php

namespace Model;


use Common\DB;

class BaseModel
{
    protected $db;
    protected $table;
    protected $validations = array();

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getAll()
    {
        $result = $this->db->query("select * from " . $this->table);
        return $result;
    }

    public function get($id)
    {
        $id = intval($id);

        $result = $this->db->query("select * from " . $this->table . " where id = " . $id );

        if(!$result) {
            return array();
        }

        return $result[0];
    }
}