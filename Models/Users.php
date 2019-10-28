<?php

class Users
{
    public $ID;
    public $UserName;

    public function __construct($ID, $UserName)
    {
        $this->ID = $ID;
        $this->UserName = $UserName;
    }
}