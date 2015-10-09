<?php
	class FriendlyUrlRule extends CBaseUrlRule
	{
		public $connectionID = 'db';
    
    public function createUrl($manager,$route,$params,$ampersand)
    {
			//file_put_contents("log.txt", print_r($params, true), FILE_APPEND);

			$frags = explode("/", $route); // рзбиваем на контроллер и действие
			if(count($frags) > 1){
				$controller = $frags[0]; // получаем оригинальный конттроллер
				$action = $frags[1]; // а также оригинальное действие

                $item_id = isset($params['id']) ? $params['id'] : '';
                unset($params['id']);
				//$params = $this->ParamsArrayIntoString($_GET); // переводим в строку
				$params = $this->ParamsArrayIntoString($params); // переводим в строку
			  $params = $params != '' ? '?'.$params : '';


				$alias = Seo::model()->findByAttributes( // пытаемся подгрузить модель псевдонима из  базы
					array('controller' => $controller, 'action' => $action, 'item_id' => $item_id) , array('condition'=>'url != "0"')
				);
			 
				if(!$alias){ // если ничего загрузить не удалось
					return false; // возращаем обычный url
				}else{ // а если удалось
					return $alias->url.$params; //возвращаем псевдоним
				}
			}
			else{
				return false;
			}
    }
   
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
			//file_put_contents("log.txt", print_r($pathInfo, true), FILE_APPEND);
			$al = $pathInfo; // предположим, что передавамый путь псевдоним
			
			$alias = Seo::model()->findByAttributes( // проверим - есть ли такой псевдоним в базе
				array('url' => $al)
			);
     
			if(!$alias){ // если ничего загрузить не удалось
				return false; // возращаем обычный url
			}else{
				//file_put_contents("log.txt", print_r($_GET, true));
				$route = $alias->controller.'/'.$alias->action; // скливаем маршрут из контроллера и действия
				//$_GET = $this->ParamsStringIntoArray('id='.$alias->item_id); // "набиваем" $_GET массив оригинальными значениями, извлекая их из строки $alias->item_id
				$_GET['id'] = $alias->item_id; 
				return $route; // возвращаем оригинальный маршрут (GET параметры уже прикреплены) 
			}
    }
   
    /* подразумевается, что в эту функцию передаётся $_GET массив параметров страницы,
		сведения о которых необходимы для назначения этой странице url-псевдонима */
    public static function ParamsArrayIntoString($arr)
    {
			$str = '';
			foreach ($arr as $key => $val){
				if($key != 'r' ){ // еслли это не маршрут
					//$str .= $val;
					$str .= $key.'='.$val.'&';
				}
				/*if($key != 'r'){ // еслли это не маршрут
					//$str .= $val;
					$str .= $key.'='.$val.'&';
				}	*/
			}
			return $str;
    }
    
    /* подразумевается, что в эта функция преобразует строку созданную
    функцией ParamsArrayIntoString() назад в массив - то есть выполнит обратное преобразование */
    public static function ParamsStringIntoArray($str)
    { 
			$arr = array();// массив-результат
			$frags = explode("&", $str);
			
			foreach ($frags as $key => $val){
			if($val != ''){ // если строка не пуста
					$frag = explode("=", $val); // разбиваем на "ключ / значение" 
					$k = $frag[0];
					$v = $frag[1];
					$arr[$k] = $v; // добавляем очередной элемент в массив-результат
					
				}
			} 
			return $arr;
    }
	}
?>