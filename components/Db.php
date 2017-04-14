<?php

class Db {
    public static function getConnection() {
        //Получаем данный из подключённого документа
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include ($paramsPath);
        //Реализуем подключение с их помощью
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        
        return $db;
    }
}

?>