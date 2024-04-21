<?php

class Copies {
    public $registration_number;
    public $registration;
    public $total;
    public $date;
    
    public function __construct($registration_number = null, $registration = null, $total = null, $date = null)
    {
        $this->registration_number = $registration_number ;
        $this->registration = $registration;
        $this->total = $total;
        $this->date = $date;
    }
}