<?php

class News {
    
    public static function getNewsItemById($id) {
        //запрос в БД
        $id = intval($id);
        
        if($id){
            // Вызываем сласс для подключенияя
            $db = Db::getConnection();
            $result = $db->query('SELECT * FROM news WHERE id='.$id);
            
            //$result->setFetchMode(PDO::FETCH_NUM);//Только номера колонок
            $result->setFetchMode(PDO::FETCH_ASSOC);//Только имена колонок
            
            $newsItem = $result->fetch();
            
            return $newsItem;
        }
    }
    public static function getNewsList(){
        //запрос в БД
        //
        // Вызываем сласс для подключенияя
        $db = Db::getConnection();
        
        $newsList = array();
        
        $rasult = $db->query('SELECT * FROM news ORDER BY id ASC LIMIT 10');

        $i = 0;
        while($row = $rasult->fetch()){
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $newsList[$i]['author_name'] = $row['author_name'];
            $newsList[$i]['image'] = $row['image'];
            $i++;
        }
        
        return $newsList;
    }
}
?>