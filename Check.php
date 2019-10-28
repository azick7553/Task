<?php
session_start();
if (!isset($_SESSION['User']) && $_SESSION['User'] == '') {
    echo false;
} else {
    echo  true;
}
