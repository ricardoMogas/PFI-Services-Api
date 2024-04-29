<?php
require_once(__DIR__ . "/../core/conexionDB.php");
require_once(__DIR__ . "/../models/Book.php");

class BookDAO extends ConexionDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $query = "SELECT * FROM book";
        $result = $this->getData($query);
        $books = array();
        foreach ($result as $row) {
            $book = new Book();
            foreach ($row as $key => $value) {
                $book->$key = $value;
            }
            $books[] = $book;
        }
        return $books;
    }

    public function GetOne($id)
    {
        $query = "SELECT * FROM book WHERE id_Book = '$id'";
        $result = $this->getData($query);
        $book = new Book();
        $book->id_Book = $result[0]['id_Book'];
        $book->id_borrowing = $result[0]['id_borrowing'];
        $book->gender = $result[0]['gender'];
        $book->title = $result[0]['title'];
        $book->publishers = $result[0]['publishers'];
        $book->author = $result[0]['author'];
        $book->status = $result[0]['status'];
        return $book;
    }

    public function GetAllWithPagination($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM book LIMIT $offset, $perPage";
        $result = $this->getData($query);
        $books = array();
        foreach ($result as $row) {
            $book = new Book();
            foreach ($row as $key => $value) {
                $book->$key = $value;
            }
            $books[] = $book;
        }
        return $books;
    }

    public function InsertBook($book)
    {
        $valid = true;
        $requiredFields = ['id_borrowing', 'gender', 'title', 'publishers', 'author', 'status'];
        foreach ($requiredFields as $field) {
            if ($book->$field == null) {
                $valid = false;
                return "El campo $field es requerido";
            }
        }

        if ($valid) {
            $query = "INSERT INTO book (id_borrowing, gender, title, publishers, author, status) VALUES (?, ?, ?, ?, ?, ?)";
            $params = [$book->id_borrowing, $book->gender, $book->title, $book->publishers, $book->author, $book->status];
            return $this->insertData($query, $params);
        }
    }

    public function UpdateBorrowingBook($id_Book, $id_borrowing)
    {
        $queryBook = "SELECT * FROM book WHERE id_Book = '$id_Book'";
        $result = $this->getData($queryBook);
        if (count($result) == 0){
            return false;
        }

        $query = "UPDATE book SET id_borrowing = ? WHERE id_Book = ?";
        $params = [$id_borrowing, $id_Book];
        return $this->updateData($query, $params);
    }
    
    public function UpdateBook($id_Book, $id_borrowing, $gender, $title, $publishers, $author, $status)
    {
        $queryBook = "SELECT * FROM book WHERE id_Book = '$id_Book'";
        $result = $this->getData($queryBook);
        if (count($result) == 0){
            return "No existe el libro";
        }

        $query = "UPDATE book SET id_borrowing = ?, gender = ?, title = ?, publishers = ?, author = ?, status = ? WHERE id_Book = ?";
        $params = [$id_borrowing, $gender, $title, $publishers, $author, $status, $id_Book];
        return $this->updateData($query, $params);
    }

    public function DeleteBook($id_Book)
    {
        $queryBook = "SELECT * FROM book WHERE id_Book = '$id_Book'";
        $result = $this->getData($queryBook);
        if (count($result) == 0){
            return "No existe el libro";
        }
        $query = "DELETE FROM book WHERE id_Book = ?";
        $params = [$id_Book];
        return $this->deleteData($query, $params);
    }
}

// USE EXAMPLE DeleteBook()
/*
$bookDAO = new BookDAO();
$result = $bookDAO->DeleteBook(51);
echo "Libro eliminado: " . ($result ? "true" : "false");
echo "<br>";
*/

// USE EXAMPLE UpdateBorrowingBook()
/*
$bookDAO = new BookDAO();
$result = $bookDAO->UpdateBorrowingBook(51, null);
echo "Libro actualizado: " . ($result ? "true" : "false");
echo "<br>";
*/

// USE EXAMPLE InsertBook()
/*
$book = new Book();
$book->id_borrowing = null;
$book->gender = "Fiction";
$book->title = "Test Book";
$book->publishers = "Test Publisher";
$book->author = "Test Author";
$book->status = "Available";
$bookDAO = new BookDAO();
$result = $bookDAO->InsertBook($book);
echo "Libro insertado: " . $result;
echo "<br>";
*/

// USE EXAMPLE GetOne()
/*
$bookDAO = new BookDAO();
$book = $bookDAO->GetOne(5);
echo $book->id_Book . " " . $book->title . " " . $book->status;
*/

// USE EXAMPLE GetAll()
/*
$bookDAO = new BookDAO();
$books = $bookDAO->GetAll();
foreach ($books as $book) {
    echo $book->id_Book . " -- " . $book->id_borrowing . " -- " . $book->title . " -- " . $book->status . "<br>";
}
*/


