<?php
//variables de la base de datos
define('DB_HOST', 'roundhouse.proxy.rlwy.net');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'DtPQUqEtfXIoVVjjISychOzpFQRKuoxm');
define('DB_NAME', 'railway');

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
define('NAME_MALE', 'Hombre');
define('NAME_FEMALE', 'Mujer');