<?php


class Computer {
    public int $id;
    public int $no_serie;
    public int $id_borrowing;
    public string $status;
    public string $model;
    public string $type;
    public string $description;

    public function __construct($id = null, $no_serie = null, $id_borrowing = null, $status = null, $model = null, $type = null, $description = null)
    {
        $this->id = $id;
        $this->no_serie = $no_serie;
        $this->id_borrowing = $id_borrowing;
        $this->status = $status;
        $this->model = $model;
        $this->type = $type;
        $this->description = $description;
    }
}