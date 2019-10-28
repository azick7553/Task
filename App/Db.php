<?php

class Db
{

    public $db;

    public function __construct()
    {
        $connect = [
            'HOSTNAME' => 'localhost', // HOST NAME
            'USERNAME' => 'c3reshai',      // DATABASE USERNAME
            'PASSWORD' => 'hc!ZgEyG9Vu',      // DATABASE PASSWORD
            'DATABASE' => 'c3reshai' // DATABASE NAME
        ];
        // $settings = $this->getPDOSettings();
        $this->db = new mysqli($connect['HOSTNAME'], $connect['USERNAME'], $connect['PASSWORD'], $connect['DATABASE']);
        if ($this->db->connect_errno) {
            echo "ErrorL : (" . $this->pdo->connect_errno . ") " . $this->db->connect_error;
        }
        $this->db->set_charset("utf8");
    }

    function db_insert($query)
    {
        return $this->db->query($query);
    }

    function db_count($table, $count = 'id')
    {
        $sql = $this->db->query("SELECT COUNT({$count}) FROM {$table}");
        $rs  = $sql->fetch_row();
        $sql->close();
        return $rs[0];
    }

    function db_get($query)
    {
        $sql = $this->db->query($query);
        if ($sql->num_rows > 0) {
            $rs = $sql->fetch_assoc();
            $sql->close();
            return $rs;
        }
    }
    function db_select($query)
    {
        $sql = $this->db->query($query);
        if ($sql->num_rows > 0) {
            while($row = $sql->fetch_assoc()) {
                $rows[]=$row;
              }
            $sql->close();
            return $rows;
        }
    }
}
