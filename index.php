<?php
    // Front controller.

    // 1. Общие настройки.
    ini_set('display_errors', 1);// Отображение ошибок
    error_reporting(E_ALL);// После окончания выключить
    // 2. Подключение файлов системы.
    define('ROOT', dirname(__FILE__));// Получения полного пути до папки на диске
    require_once(ROOT.'/components/Router.php');// Подключить однажды роутер
    // 3. Установка соединения с БД.
    require_once(ROOT.'/components/Db.php');// Подключить однажды ДБ коннектор
    // 4. Вызов Router
    $router = new Router();
    $router->run();
?>