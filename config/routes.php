<?php
    // Файл с путями
    return array(
        //'powerful/index.php/news/([a-z]+)/([0-9]+)'=>'news/view/$1/$2',
        'powerful/index.php/news/([0-9]+)'=>'news/view/$1',// Одна новость регулярное выражение
        'powerful/index.php/news'=>'news/index',// actionIndex в NewsController

        //'products'=>'product/list',// actionList в ProductController
    );
?>

