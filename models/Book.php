<?php
class Book {
    public int $id_Book;
    public int $id_borrowing;
    public string $gender;
    public string $title;
    public string $publishers;
    public string $author;
    public string $status;
    
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