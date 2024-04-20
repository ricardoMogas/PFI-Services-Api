<?php

class locker {
    public int $id_locker;
    public int $id_borrowing;
    public int $status;
    public string $description;
    
    public function __construct($id_locker = null, $id_borrowing = null, $status = null, $description = null)
    {
        $this->id_locker = $id_locker;
        $this->id_borrowing = $id_borrowing;
        $this->status = $status;
        $this->description = $description;
    }
}