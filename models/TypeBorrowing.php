<?php
class TypeBorrowing {
    public int $id_type;
    public string $name;

    public function __construct($id_type = null, $name = null)
    {
        $this->id_type = $id_type;
        $this->name = $name;
    }
}