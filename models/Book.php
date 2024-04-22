<?php
class Book {
    public $id_Book;
    public $id_borrowing;
    public $gender;
    public $title;
    public $publishers;
    public $author;
    public $status;
    
    public function __construct($id_Book = null, $id_borrowing = null, $gender = null, $title = null, $publishers = null, $author = null, $status = null)
    {
        $this->id_Book = $id_Book;
        $this->id_borrowing = $id_borrowing;
        $this->gender = $gender;    
        $this->title = $title;
        $this->publishers = $publishers;
        $this->author = $author;
        $this->status = $status;
    }
}