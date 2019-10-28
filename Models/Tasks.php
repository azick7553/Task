<?php
class Tasks
{
    public $ID;
    public $UserName;
    public $Email;
    public $TaskMessage;
    public $IsCompleted;
    public $CompletedDate;
    public $InsertedDate;
    public $UpdatedDate;
    public $IsModified;
    public function __construct($ID, $UserName, $Email, $TaskMessage, $IsCompleted = 0, $CompletedDate, $InsertedDate, $UpdatedDate, $IsModified) 
    {
        $this->ID = $ID;
        $this->UserName = $UserName;
        $this->Email = $Email;
        $this->TaskMessage = $TaskMessage;
        $this->IsCompleted = $IsCompleted;
        $this->CompletedDate = $CompletedDate;
        $this->InsertedDate = $InsertedDate;
        $this->UpdatedDate = $UpdatedDate;
        $this->IsModified = $IsModified;
    }
}
