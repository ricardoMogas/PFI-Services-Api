<?php

class UnregisteredVisits
{
    public $no_Visit;
    public $registration;
    public $entry_time;
    public $exit_time;
    public $visit_date;

    public function __construct($no_Visit = null, $registration = null, $entry_time = null, $exit_time = null, $visit_date = null)
    {
        $this->no_Visit = $no_Visit;
        $this->registration = $registration;
        $this->entry_time = $entry_time;
        $this->exit_time = $exit_time;
        $this->visit_date = $visit_date;
    }

    // Getters and Setters

    public function getNoVisit()
    {
        return $this->no_Visit;
    }

    public function setNoVisit($no_Visit)
    {
        $this->no_Visit = $no_Visit;
    }

    public function getRegistration()
    {
        return $this->registration;
    }

    public function setRegistration($registration)
    {
        $this->registration = $registration;
    }

    public function getEntryTime()
    {
        return $this->entry_time;
    }

    public function setEntryTime($entry_time)
    {
        $this->entry_time = $entry_time;
    }

    public function getExitTime()
    {
        return $this->exit_time;
    }

    public function setExitTime($exit_time)
    {
        $this->exit_time = $exit_time;
    }

    public function getVisitDate()
    {
        return $this->visit_date;
    }

    public function setVisitDate($visit_date)
    {
        $this->visit_date = $visit_date;
    }
}