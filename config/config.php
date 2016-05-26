<?php
// номер сервера, к которому подключаться
$connect_server = 3;

// Подключение к серверу и базе данных
switch($connect_server){
    case 1:
        // подключение к локальному серверу на Mac OS
        define('PATH', 'http://credit-bsb.loc/'); // домен
        define('HOST', 'localhost'); // сервер
        define('USER', 'root'); // пользователь
        define('PASS', 'root'); // пароль
        define('DB', 'credit_bsb'); // БД
        break;
    case 2:
        // подключение к локальному серверу на Windows OS
        define('PATH', 'http://credit-bsb.loc/'); // домен
        define('HOST', 'localhost'); // сервер
        define('USER', 'root'); // пользователь
        define('PASS', ''); // пароль
        define('DB', 'credit_bsb'); // БД
        break;
    case 3:
        // подключение к хостингу
        define('PATH', 'http://dimaaa.tmweb.ru/'); // домен
        define('HOST', 'localhost'); // сервер
        define('USER', 'dimaaa_credit'); // пользователь
        define('PASS', 'dimaaa_credit'); // пароль
        define('DB', 'dimaaa_credit'); // БД
        break;
}

mysql_connect(HOST, USER, PASS) or die('Не удалось подключиться к серверу');
mysql_select_db(DB) or die('Не удалось открыть БД');
mysql_query("SET NAMES 'UTF8'") or die('Не удалось установить кодировку');
?>