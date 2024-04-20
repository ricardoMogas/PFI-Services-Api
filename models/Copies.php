<?php

class Copies {
    public int $registration_number;
    public int $registration;
    public int $total;
    public string $date;
    
    public function __construct($registration_number = null, $registration = null, $total = null, $date = null)
    {
        $this->registration_number = $registration_number;
        $this->registration = $registration;
        $this->total = $total;
        $this->date = $date;
    }
}