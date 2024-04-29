<?php

class RegisteredVisits {
    public $no_Visit;
    public $registration;
    public $entry_time;
    public $exit_time;
    public $visit_date;

    // Constructor
    public function __construct($no_Visit = null, $registration = null, $entry_time = null, $exit_time = null, $visit_date = null) {
        $this->no_Visit = $no_Visit;
        $this->registration = $registration;
        $this->entry_time = $entry_time;
        $this->exit_time = $exit_time;
        $this->visit_date = $visit_date;
    }
}