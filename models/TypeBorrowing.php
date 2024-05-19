<?php
class TypeBorrowing {
    public $id_type;
    public $name;

    public function __construct($id_type = null, $name = null)
    {
        $this->id_type = $id_type;
        $this->name = $name;
    }
}