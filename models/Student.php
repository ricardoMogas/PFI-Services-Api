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
    
    public function __construct($registration = null, $name = null, $p_last_name = null, $m_last_name = null, $gender = null, $birthday_date = null, $ethnicity = null, $origin_place = null, $date_of_registration = null)
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
    }
    public function getRegistration()
    {
        return $this->registration;
    }

    public function setRegistration($registration)
    {
        $this->registration = $registration;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPLastName()
    {
        return $this->p_last_name;
    }

    public function setPLastName($p_last_name)
    {
        $this->p_last_name = $p_last_name;
    }

    public function getMLastName()
    {
        return $this->m_last_name;
    }

    public function setMLastName($m_last_name)
    {
        $this->m_last_name = $m_last_name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getBirthdayDate()
    {
        return $this->birthday_date;
    }

    public function setBirthdayDate($birthday_date)
    {
        $this->birthday_date = $birthday_date;
    }

    public function getEthnicity()
    {
        return $this->ethnicity;
    }

    public function setEthnicity($ethnicity)
    {
        $this->ethnicity = $ethnicity;
    }

    public function getOriginPlace()
    {
        return $this->origin_place;
    }

    public function setOriginPlace($origin_place)
    {
        $this->origin_place = $origin_place;
    }

    public function getDateOfRegistration()
    {
        return $this->date_of_registration;
    }

    public function setDateOfRegistration($date_of_registration)
    {
        $this->date_of_registration = $date_of_registration;
    }

}