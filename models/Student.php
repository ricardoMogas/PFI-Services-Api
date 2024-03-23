<?php
class Student {
    public $registration;
    public $name;
    public $p_last_name;
    public $m_last_name;
    public $gender;
    public $birthday_date;
    public $ethnicity;
    public $origin_place;
    public $date_of_registration;
    public $career;
    public $status; 
    
    public function __construct($registration = null, $name = null, $p_last_name = null, $m_last_name = null, $gender = null, $birthday_date = null, $ethnicity = null, $origin_place = null, $date_of_registration = null, $career = null, $status = null)
    {
        $this->registration = $registration;
        $this->name = $name;
        $this->p_last_name = $p_last_name;
        $this->m_last_name = $m_last_name;
        $this->gender = $gender;
        $this->birthday_date = $birthday_date;
        $this->ethnicity = $ethnicity;
        $this->origin_place = $origin_place;
        $this->date_of_registration = $date_of_registration;
        $this->career = $career;
        $this->status = $status;
    }
    
    // Getter and Setter methods for $registration
    public function getRegistration()
    {
        return $this->registration;
    }

    public function setRegistration($registration)
    {
        $this->registration = $registration;
    }

    // Getter and Setter methods for $name
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Getter and Setter methods for $p_last_name
    public function getPLastName()
    {
        return $this->p_last_name;
    }

    public function setPLastName($p_last_name)
    {
        $this->p_last_name = $p_last_name;
    }

    // Getter and Setter methods for $m_last_name
    public function getMLastName()
    {
        return $this->m_last_name;
    }

    public function setMLastName($m_last_name)
    {
        $this->m_last_name = $m_last_name;
    }

    // Getter and Setter methods for $gender
    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    // Getter and Setter methods for $birthday_date
    public function getBirthdayDate()
    {
        return $this->birthday_date;
    }

    public function setBirthdayDate($birthday_date)
    {
        $this->birthday_date = $birthday_date;
    }

    // Getter and Setter methods for $ethnicity
    public function getEthnicity()
    {
        return $this->ethnicity;
    }

    public function setEthnicity($ethnicity)
    {
        $this->ethnicity = $ethnicity;
    }

    // Getter and Setter methods for $origin_place
    public function getOriginPlace()
    {
        return $this->origin_place;
    }

    public function setOriginPlace($origin_place)
    {
        $this->origin_place = $origin_place;
    }

    // Getter and Setter methods for $date_of_registration
    public function getDateOfRegistration()
    {
        return $this->date_of_registration;
    }

    public function setDateOfRegistration($date_of_registration)
    {
        $this->date_of_registration = $date_of_registration;
    }

    // Getter and Setter methods for $career
    public function getCareer()
    {
        return $this->career;
    }

    public function setCareer($career)
    {
        $this->career = $career;
    }

    // Getter and Setter methods for $status
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}