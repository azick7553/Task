<?php
namespace Controllers;

use Db;
use Users;

class Account extends \App\Controller
{
    public function index()
    {
        session_start();
        if (isset($_SESSION['User']) && $_SESSION['User'] != '') {
            header("location: /");
        }
        return $this->render('Index', 'Account', (array) null);
    }

    public function LogIn()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!isset($_POST['UserName']) && !isset($_POST['Password'])) {
                die('Error');
            }
            $userName = $_POST['UserName'];
            $passwrod = $_POST['Password'];

            $db = new Db();
            $result = $db->db_get("SELECT * FROM `Users` WHERE upper(UserName) = upper('$userName') limit 1");
            if ($result === null) {
                return $this->render('Index', 'Account', (array) array('error' => '1Не правильный логин или пароль.'));
            }
            if (password_verify($passwrod, $result['Password'])) {
                session_start();
                $user = new Users($result['ID'], $result['UserName']);
                $_SESSION['User'] = $user;
                $_SESSION['LAST_ACTIVITY'] = time();
                header("location: /");
            } else {
                return $this->render('Index', 'Account', (array) array('error' => '2Не правильный логин или пароль.'));
            }
        } else {
            die('Error');
        }
    }

    public function LogOut()
    {
        session_start();
        $_SESSION['User'] = null;
        session_unset();
        session_destroy();
        header("location: /");
    }
}
