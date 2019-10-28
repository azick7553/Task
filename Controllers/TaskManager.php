<?php
namespace Controllers;
use Db;

class TaskManager extends \App\Controller
{
    public function index()
    {
        return $this->render('Index', 'TaskManager', (array)null);
    }

    public function AddTask()
    {
        $_SESSION['successMessage'] = null;
        if (!isset($_POST['UserName']) && !isset($_POST['Email']) && !isset($_POST['TaskMessage'])) {
            return $this->render('Index', 'TaskManager', (array) null);
        }
        $userName = $_POST['UserName'];
        $Email = $_POST['Email'];
        $TaskMessage = $_POST['TaskMesssage'];
        $db = new Db();
        $result = $db->db_insert("INSERT INTO `Tasks`(`UserName`, `Email`, `TaskMessage`, `InsertedDate`) VALUES ('$userName','$Email','$TaskMessage',CURRENT_TIMESTAMP())");
        session_start();
        $_SESSION['successMessage'] = 'Успешно добавлен';
        header("location: /");
    }
    public function EditTask()
    {
        session_start();
        if (!isset($_GET['id'])) {
            header("location: /");
        }
        if (!isset($_SESSION['User'])&&$_SESSION['User'] == '') {
            header("location: /Account");
        }
        $id = $_GET['id'];
        $db = new Db();
        $result = $db->db_get("SELECT * FROM `Tasks` where ID = $id");
        return $this->render('EditTask', 'TaskManager', (array) $result);
    }
    public function ModifyTask()
    {
        session_start();
        if (!isset($_POST['ID'])) {
            header("location: /");
        }
        if (!isset($_SESSION['User'])) {
            header("location: /Account");
        }
        $taskMessage = $_POST['TaskMessage'];
        $isCompleted = $_POST['IsCompleted'] == '1' ? 1 : 0;
        $id = $_POST['ID'];
        $db = new Db();
        $result = $db->db_insert("UPDATE 
                                        `Tasks`
                                        SET 
                                            `IsCompleted`= $isCompleted,
                                            `UpdatedDate`= case when `TaskMessage` != '$taskMessage' THEN CURRENT_TIMESTAMP() else `UpdatedDate` END,
                                            `CompletedDate`= case when $isCompleted = 1 then CURRENT_TIMESTAMP() else `CompletedDate` end,
                                            `IsModified`= case when `TaskMessage` != '$taskMessage' then 1 else `IsModified` end, 
                                            `TaskMessage`= '$taskMessage'
                                        WHERE `ID` = $id", (array)null);
        header("location: /");
        $_SESSION['successMessageModify'] = 'Успешно изменен';
    }
}
