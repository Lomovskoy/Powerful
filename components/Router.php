<?php
// Маршрутизатор
class Router 
{
    private $routes;//Массив для хранения маршрутов
    
    public function __construct() 
    {
        
        $routersPath = ROOT.'/config/routes.php';//Пусть к роутам
        $this->routes = include($routersPath);// Присваиваем полю роутс массив из файла
    }
    // Получение строки запроса
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
            
    public function run() // Принимает управления от фронт контроллера
    {
        // Получить строку запроса
        echo 'Получить строку запроса: [';
        $uri = $this->getURI();
        echo $uri;
        echo ']<hr>';
        
        // Проверить наличие запроса на routes.php
        echo 'Проверить наличие запроса на routes.php<br>';
        
        foreach ($this->routes as $uriPattern => $path)
        {
            // Сравнение $uriPattern и $uri
            
            echo 'Сравнение запроса: '.$uriPattern." С шаблоном: ".$uri."<br>";
            
            if(preg_match("~$uriPattern~", $uri))
            {
                echo '<hr>';
                echo 'Совпадение найденно<br>';
                // Разделителем выступает ~ так как в запросе может
                // содержатся /uri/Pattern/ и т.д.
                // Еслиесть совпадение, проверить какой
                // контроллет или action обрабатывает запрос 
                //Разделитель по знаку
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                echo 'Вырезанный адрес: '.$internalRoute;
                
                //Определяем контроллер экшн и параметр
                echo'<br>Kонтроллер экшн и параметры - ';
                $segments = explode('/', $internalRoute);
                
                //----костыль потому, что на лдокальном хостинге удаляю ненужные имена в адресе
                //echo '<pre>';                               //
                //print_r($segments);                         //
                //unset($segments[0]);                        //
                //unset($segments[1]);                        //
                //echo '<pre>';                               //
                print_r($segments);
                //echo'</pre>';//
                //-----------------------------------------------------------------------------
                //Получает значение первого элемента массива и удаляет его из массива
                $controllerName = array_shift($segments).'Controller';//прибавялем к полукченному значению Контроллер
                $controllerName = ucfirst($controllerName);// Делаем первую букву строку заглавной
                //-----------------------------------------------------------------------------
                $actionName = 'action'.ucfirst(array_shift($segments));//Получаем экшен
                //array_shift берёт из массива 1й элемент и удалаяет его передавя в переменную
                echo '<br>Controller Name: '.$controllerName;
                echo '<br>Action Name: '.$actionName;
                echo '<hr>';
                
                $patametrs = $segments;
                
                //echo '<pre>';
                //print_r($patametrs);
                
                //die; - зхерня из за которой ничего не работало exit
                
                // Подключить файл класса котроллер
                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';
                
                echo 'Подключить файл класса котроллер: '.$controllerFile;
                
                //Проверка существования файла
                if(file_exists($controllerFile))
                {
                    include_once ($controllerFile);
                }
                // Создать обьект вызвать метод(т.е action)
                //echo $controllerName;
                $controllerObject = new $controllerName;
                echo '</>';
                echo '<br>Создаём обьект: ';
                print_r($controllerObject); 
                echo '<br>Вызываем пользовательскую функцию с массивом параметров: ';
                echo '<hr>';
                // Вывзвывает экшен с имением экшн нейм у обьекута контроллер обжект и передаёт ему массив с параметрами
                $result = call_user_func_array(array($controllerObject, $actionName),$patametrs);
                
                if($result != null) 
                {
                    break;
                }
            }
            else {
                echo 'Совпадений не найденно.';
            }
        }
    }
}
// Маршруты будут хранить в массиве в огтдельном файле,
// так работают фреймворки Yii, Symfony
?>