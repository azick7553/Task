<?php

namespace Controllers;

use Db;
use Tasks;

class Home extends \App\Controller
{
    public function index()
    {
        session_start();
        $_SESSION['pagination'] = null;
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $db = new Db();

        $no_of_records_per_page = 3;
        $offset = ($pageno - 1) * $no_of_records_per_page;

        $total_pages_sql = $db->db_count('Tasks');
        $total_rows =  $total_pages_sql;
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        if (isset($_GET['sortUserName'])) {
            $sortUserName =  $_GET['sortUserName'];
            $result = $db->db_select("SELECT * FROM `Tasks` order by UserName $sortUserName LIMIT $offset, $no_of_records_per_page");
        } else if (isset($_GET['sortEmail'])) {
            $sortEmail =  $_GET['sortEmail'];
            $result = $db->db_select("SELECT * FROM `Tasks` order by Email $sortEmail LIMIT $offset, $no_of_records_per_page");
        } else if (isset($_GET['sortStatus'])) {
            $sortStatus =  $_GET['sortStatus'];
            $result = $db->db_select("SELECT * FROM `Tasks` order by IsCompleted $sortStatus LIMIT $offset, $no_of_records_per_page");
        } else {
            $result = $db->db_select("SELECT * FROM `Tasks` order by InsertedDate desc LIMIT $offset, $no_of_records_per_page");
        }
        $_SESSION['pagination'] =
            [
                'total_pages' => $total_pages,
                'pageno' => $pageno,
                'sortUserName' => $sortUserName,
                'sortEmail' => $sortEmail,
                'sortStatus' => $sortStatus
            ];
        return $this->render('Index', 'Home', (array)$result);
    }
}
