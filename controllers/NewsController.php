<?php

    include_once ROOT.'/model/News.php';

    class NewsController {
       
        public function actionIndex()
        {
            $newList = array();
            $newList = News::getNewsList();
            
            //echo '<pre>';
            //print_r($newList);
            //echo '</pre>';
            
            include_once (ROOT.'/view/news/index.php');
            
            return true;
        }
        
        public function actionView($id)
        {
            if($id){
                $newItem = News::getNewsItemById($id);
                echo '<pre>';
                print_r($newItem);
                echo '</pre>';
                echo 'actionView';
            }
            return true;
        }
    }

?>