<?php
//variables de la base de datos
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pfiv3');

// Type_borrowing (tipo de prestamo)
/*
por favor compruebe que los valores sean iguales a los de
la tabla en la base de datos type_borrowing
*/
define('computer', 1);
define('book', 2);
define('locker', 3);

define('computer_name', "computer");
define('book_name', "book");
define('locker_name', "locker");


//otras variables
define('TOTAL_COPIES', 50);
define('OCUPATE_NAME', 'Ocupado');
define('FREE_NAME', 'Libre');
define('OUT_OF_SERVICE_NAME', 'Fuera de servicio');
define('SITE_NAME', 'ApiCLiente');
define('API_URL', 'https://api.testdb.com');