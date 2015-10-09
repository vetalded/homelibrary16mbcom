<?php

class UserFunctions 
{
    public static function translit($insert)
 {

     $insert = mb_strtolower($insert,'UTF-8');    // Если работаем с юникодными строками
     //$insert = strtolower("ВВВ"); // Все почему-то упорно переводят и заглавные и прописные, а потом делают strtolower Я сделал сразу, тем самым уменьшив массив

     $replase = array(
         // Буквы
         'а'=>'a',
         'б'=>'b',
         'в'=>'v',
         'г'=>'g',
         'д'=>'d',
         'е'=>'e',
         'ё'=>'yo',
         'ж'=>'zh',
         'з'=>'z',
         'и'=>'i',
         'й'=>'j',
         'к'=>'k',
         'л'=>'l',
         'м'=>'m',
         'н'=>'n',
         'о'=>'o',
         'п'=>'p',
         'р'=>'r',
         'с'=>'s',
         'т'=>'t',
         'у'=>'u',
         'ф'=>'f',
         'х'=>'h',
         'ц'=>'c',
         'ч'=>'ch',
         'ш'=>'sh',
         'щ'=>'shh',
         'ъ'=>'j',
         'ы'=>'y',
         'ь'=>'',
         'э'=>'e',
         'ю'=>'yu',
         'я'=>'ya',
         // Всякие знаки препинания и пробелы
         ' '=>'_',
         ' - '=>'-',
         '_'=>'_',
         //Удаляем
         '.'=>'',
         ':'=>'',
         ';'=>'',
         ','=>'',
         '!'=>'',
         '?'=>'',
         '>'=>'',
         '<'=>'',
         '&'=>'',
         '*'=>'',
         '%'=>'',
         '$'=>'',
         '"'=>'',
         '\''=>'',
         '('=>'',
         ')'=>'',
         '`'=>'',
         '+'=>'',
         '/'=>'',
         '\\'=>'',
     );
     $insert=preg_replace("/  +/"," ",$insert); // Удаляем лишние пробелы
     $insert = strtr($insert,$replase);

     return $insert;
 }




public static function GetBugsDate($dt, $no_year = null)
  {
		$new_dt = "";
		if($dt>0){
			$date = new DateTime($dt);
      if(is_null($no_year))
        $new_dt = $date->format('d.m.Y');
      else 
        $new_dt = $date->format('d.m');
		}
		return $new_dt;
  }
	
	public static function GetUnits() 
  {
		$array = array(0=>Yii::t('trans','Bugs & Milestones'), 1=>Yii::t('trans','Bugs'), 2=>Yii::t('trans','Milestones'));
		return $array;
  }
    public static function shorten($msg, $length, $suffix = '…'){
        if (mb_strlen($msg, 'utf8') <= $length) return $msg;
        $msg=strip_tags($msg);
        $offset = 0;

        while(true) {
            $newOffset = mb_strpos($msg, ' ', $offset + 1, 'utf8');
            if ($newOffset === false || $newOffset > $length) {
                break;
            }
            $offset = $newOffset;
        }

        $result = mb_substr($msg, 0, $offset, 'utf8');
        $result = trim($result, " \t\n\r\0\x0B,.:#");

        return $result . $suffix;
    }
	public static  function days(){
        $params=array();
        for($i=1;$i<31;$i++){
            $params[$i]=$i;
        }
        return $params;
    }
    public static  function years($start){
        $params=array();
        for($i=$start;$i<date("Y");$i++){
            $params[$i]=$i;
        }
        return $params;
    }
    public static  function month(){
        $params=array(
            1=>"Січень",
            2=>"Лютий",
            3=>"Березень",
            4=>"Квітень",
            5=>"Травень",
            6=>"Червень",
            7=>"Липень",
            8=>"Серпень",
            9=>"Вересень",
            10=>"Жовтень",
            11=>"Листопад",
            12=>"Грудень",
    );
       return $params;
    }
    public static  function months(){
        $params=array(
            1=>Yii::t('trans','January'),
            2=>Yii::t('trans','February'),
            3=>Yii::t('trans','March'),
            4=>Yii::t('trans','April'),
            5=>Yii::t('trans','May'),
            6=>Yii::t('trans','June'),
            7=>Yii::t('trans','July'),
            8=>Yii::t('trans','August'),
            9=>Yii::t('trans','September'),
            10=>Yii::t('trans','October'),
            11=>Yii::t('trans','November'),
            12=>Yii::t('trans','December'),
    );
       return $params;
    }
    public static function getCommentDate($dt)
    {
            $date = new DateTime($dt);

                $day = $date->format('d');
                $months=UserFunctions::months();
                $month = $months[intval($date->format('m'))];
                $year = $date->format('Y');
                $time = $date->format('H:i:s');
        $new_dt=$day." ".$month." ".$year." ".Yii::t('trans','at')." ".$time;
        return $new_dt;
    }

}