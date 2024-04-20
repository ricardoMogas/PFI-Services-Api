<?php
class Borrowing {
    public int $id_borrowing;
    public int $registration;
    public int $type_borrowing;
    public string $borrowing_date;
    public string $return_date;

    public function __construct($id_borrowing = null, $registration = null, $type_borrowing = null, $borrowing_date = null, $return_date = null)
    {
        $this->id_borrowing = $id_borrowing;
        $this->registration = $registration;
        $this->type_borrowing = $type_borrowing;
        $this->borrowing_date = $borrowing_date;
        $this->return_date = $return_date;
    }
}