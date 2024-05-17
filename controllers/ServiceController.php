<?php
require_once __DIR__ . "/../core/responseData.class.php";
require_once __DIR__ . "/../models/Student.php";
require_once __DIR__ . "/../dao/StudentDAO.php";
require_once __DIR__ . "/../dao/BookDAO.php";
require_once __DIR__ . "/../dao/ComputerDAO.php";
require_once __DIR__ . "/../dao/LockerDAO.php";
require_once __DIR__ . "/../models/Borrowing.php";
require_once __DIR__ . "/../dao/BorrowingDAO.php";

class ServiceController extends responseData
{
    public function index(...$params)
    {
        /**
         * SI NO EXISTE EL doGet, doPost, doDelete y doPut
         * ENTONCES SE EJECUTA EL INDEX COMO METODO PRESETERMINADO
         **/
    }
    /**
     * ENDPOINT >/Service?TypeBorrowing=computer
     */
    public function doGet(...$params)
    {
        $computerDAO = new ComputerDAO();
        $bookDAO = new BookDAO();
        $lockerDAO = new LockerDAO();
        $borrowingDAO = new BorrowingDAO();
        if (!isset($params["TypeBorrowing"])) {
            return parent::sendJsonResponse("error", "TypeBorrowing is required");
        }

        switch ($params["TypeBorrowing"]) {
            case "locker":
                $result = $lockerDAO->GetAll();
                if ($result == false) {
                    return parent::sendJsonResponse("error", "Locker not found");
                }
                foreach ($result as &$item) {
                    $borrowingData = $borrowingDAO->GetOne($item->id_borrowing);
                    if ($item->id_borrowing != null) {
                        $item->id_borrowing = $borrowingData;
                    }
                }
                return parent::sendJsonResponse("ok", $result);
                break;
            case "computer":
                $result = $computerDAO->GetAll();
                if ($result == false) {
                    return parent::sendJsonResponse("error", "Locker not found");
                }
                foreach ($result as &$item) {
                    $borrowingData = $borrowingDAO->GetOne($item->id_borrowing);
                    if ($item->id_borrowing != null) {
                        $item->id_borrowing = $borrowingData;
                    }
                }
                return parent::sendJsonResponse("ok", $result);
                break;
            case "Book":
                $result = $bookDAO->GetAll();
                if ($result == false) {
                    return parent::sendJsonResponse("error", "Locker not found");
                }
                foreach ($result as &$item) {
                    $borrowingData = $borrowingDAO->GetOne($item->id_borrowing);
                    if ($item->id_borrowing != null) {
                        $item->id_borrowing = $borrowingData;
                    }
                }
                return parent::sendJsonResponse("ok", $result);
                break;
            default:
                return parent::sendJsonResponse("error", "TypeBorrowing not found");
                break;
        }
    }

    public function doPost(...$params)
    {
        $computerDAO = new ComputerDAO();
        $bookDAO = new BookDAO();
        $lockerDAO = new LockerDAO();
        $borrowing = new Borrowing();
        $borrowingDAO = new BorrowingDAO();
        if (
            !isset($params["TypeBorrowing"]) && isset($params["item_id"]) && !isset($params["registration"])
            && !isset($params["return_date"]) && !isset($params["date"])
        ) {
            return parent::sendJsonResponse("error", "TypeBorrowing and registration is required");
        }

        if (!$this->validate_date($params["date"]) || !$this->validate_date($params["return_date"])) {
            return parent::sendJsonResponse("error", "Invalid date format");
        }
        switch ($params["TypeBorrowing"]) {
            case "locker":
                // Verificar si el locker esta prestado y si la fecha de retorno no expiro
                $borrowingLocker = $lockerDAO->GetOne($params["item_id"]);
                $borrowingData = $borrowingDAO->GetOne($borrowingLocker->id_borrowing);
                if ($borrowingLocker->id_borrowing != null) {
                    return parent::sendJsonResponse("error", "Locker is borrowed and not returned yet, return date " . $borrowingData->return_date . " and student " . $borrowingData->registration);
                }
                // Hacer el insert en la tabla borrowing
                $borrowing->registration = $params["registration"];
                $borrowing->type_borrowing = $params["TypeBorrowing"];
                $borrowing->borrowing_date = $params["date"];
                $borrowing->return_date = $params["return_date"];
                $borrowingId = $borrowingDAO->InsertBorrowing($borrowing);
                if ($borrowingId == false) {
                    return parent::sendJsonResponse("error", "Borrowing not created: " . ($borrowingId ? "true" : "false"));
                }
                $UpdateBorrowingLocker = $lockerDAO->UpdateBorrowingLoker($params["item_id"], $borrowingId);
                return parent::sendJsonResponse("ok", $UpdateBorrowingLocker);
                break;
            case "computer":
                // Verificar si la computadora esta prestada y si la fecha de retorno no expiro
                $borrowingComputer = $computerDAO->GetOne($params["item_id"]);
                $borrowingData = $borrowingDAO->GetOne($borrowingComputer->id_borrowing);
                if ($borrowingComputer->id_borrowing !== null) {
                    return parent::sendJsonResponse("error", "Computer is borrowed and not returned yet, return date " . $borrowingData->return_date . " and student " . $borrowingData->registration);
                }
                // Hacer el insert en la tabla borrowing
                $borrowing->registration = $params["registration"];
                $borrowing->type_borrowing = $params["TypeBorrowing"];
                $borrowing->borrowing_date = $params["date"];
                $borrowing->return_date = $params["return_date"];
                $borrowingId = $borrowingDAO->InsertBorrowing($borrowing);
                if ($borrowingId == false) {
                    return parent::sendJsonResponse("error", "Borrowing not created: " . ($borrowingId ? "true" : "false"));
                }
                $UpdateBorrowingComputer = $computerDAO->UpdateBorrowingComputer($params["item_id"], $borrowingId);
                return parent::sendJsonResponse("ok", $UpdateBorrowingComputer);
                break;
            case "book":
                // Verificar si el libro esta prestado y si la fecha de retorno no expiro
                $borrowingBook = $bookDAO->GetOne($params["item_id"]);
                $borrowingData = $borrowingDAO->GetOne($borrowingBook->id_borrowing);
                if ($borrowingBook->id_borrowing != null) {
                    return parent::sendJsonResponse("error", "Book is borrowed and not returned yet, return date " . $borrowingData->return_date . " and student " . $borrowingData->registration);
                }
                // Hacer el insert en la tabla borrowing
                $borrowing->registration = $params["registration"];
                $borrowing->type_borrowing = $params["TypeBorrowing"];
                $borrowing->borrowing_date = $params["date"];
                $borrowing->return_date = $params["return_date"];
                $borrowingId = $borrowingDAO->InsertBorrowing($borrowing);
                if ($borrowingId == false) {
                    return parent::sendJsonResponse("error", "Borrowing not created: " . ($borrowingId ? "true" : "false"));
                }
                $UpdateBorrowingBook = $bookDAO->UpdateBorrowingBook($params["item_id"], $borrowingId);
                return parent::sendJsonResponse("ok", $UpdateBorrowingBook);
                break;
            default:
                return parent::sendJsonResponse("error", "TypeBorrowing not found");
                break;
        }
    }
    /**
     * Enviar tipo de prestamo y el id del del libro/computadora/locker
     * para actualizar el id_borrowing a null en el libro/computadora/locker
     * y asi determinar que el prestamo finalizo, igual actualizara la fecha
     * de retorno a la fecha actual.
     * ENDPOINT > /Service?TypeBorrowing=book&item_id=50
     */
    public function doPut(...$params)
    {
        $computerDAO = new ComputerDAO();
        $bookDAO = new BookDAO();
        $lockerDAO = new LockerDAO();
        $borrowingDAO = new BorrowingDAO();
        if (!isset($params["TypeBorrowing"]) && !isset($params["item_id"])) {
            return parent::sendJsonResponse("error", "required fields are missing");
        }

        switch ($params["TypeBorrowing"]) {
            case "locker":
                $locker = $lockerDAO->GetOne($params["item_id"]);
                $resultLockerStatus = $lockerDAO->UpdateBorrowingLoker($params["item_id"], null);
                if ($locker->id_borrowing == null) {
                    return parent::sendJsonResponse("error", "Locker is not borrowed");
                }
                if ($resultLockerStatus == false) {
                    return parent::sendJsonResponse("error", "Locker status not updated");
                }
                $resultUpdateDate = $borrowingDAO->UpdateBorrowing($locker->id_borrowing, null, null, null, date("Y-m-d H:i:s"));
                return parent::sendJsonResponse("ok", $resultLockerStatus && $resultUpdateDate);
                break;
            case "computer":
                $computer = $computerDAO->GetOne($params["item_id"]);
                $resultComputerStatus = $computerDAO->UpdateBorrowingComputer($params["item_id"], null);
                if ($computer->id_borrowing == null) {
                    return parent::sendJsonResponse("error", "Computer is not borrowed");
                }
                if ($resultComputerStatus == false) {
                    return parent::sendJsonResponse("error", "Computer status not updated");
                }
                $resultUpdateDate = $borrowingDAO->UpdateBorrowing($computer->id_borrowing, null, null, null, date("Y-m-d H:i:s"));
                return parent::sendJsonResponse("ok", $resultComputerStatus && $resultUpdateDate);
                break;
            case "book":
                $book = $bookDAO->GetOne($params["item_id"]);
                $resultBookStatus = $bookDAO->UpdateBorrowingBook($params["item_id"], null);
                if ($book->id_borrowing == null) {
                    return parent::sendJsonResponse("error", "Book is not borrowed");
                }
                if ($resultBookStatus == false) {
                    return parent::sendJsonResponse("error", "Book status not updated");
                }
                $resultUpdateDate = $borrowingDAO->UpdateBorrowing($book->id_borrowing, null, null, null, date("Y-m-d H:i:s"));
                return parent::sendJsonResponse("ok", $resultBookStatus && $resultUpdateDate);
                break;
            default:
                return parent::sendJsonResponse("error", "TypeBorrowing not found");
                break;
        }
    }

    private function validate_date($date_string)
    {
        $date_parts = explode(' ', $date_string);

        if (count($date_parts) < 2) {
            return false;
        }

        if (strtotime($date_string) === false) {
            return false;
        }

        return true;
    }
}
