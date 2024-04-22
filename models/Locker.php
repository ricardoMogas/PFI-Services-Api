<?php

class locker {
    public $id_locker;
    public $id_borrowing;
    public $status;
    public $description;
    
    public function __construct($id_locker = null, $id_borrowing = null, $status = null, $description = null)
    {
        $this->id_locker = $id_locker;
        $this->id_borrowing = $id_borrowing;
        $this->status = $status;
        $this->description = $description;
    }
}