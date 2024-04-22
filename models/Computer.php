<?php


class Computer {
    public $id;
    public $no_series;
    public $id_borrowing;
    public $status;
    public $model;
    public $type;
    public $description;

    public function __construct($id = null, $no_series = null, $id_borrowing = null, $status = null, $model = null, $type = null, $description = null)
    {
        $this->id = $id;
        $this->no_series = $no_series;
        $this->id_borrowing = $id_borrowing;
        $this->status = $status;
        $this->model = $model;
        $this->type = $type;
        $this->description = $description;
    }
}