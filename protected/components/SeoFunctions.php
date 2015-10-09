<?php
class SeoFunctions
{

	public static function seoManagerCreate($controller, $action, $item_id)
	{ 
		$seo = Seo::model()->findByAttributes(array('controller'=>$controller, 'action'=>$action, 'item_id'=>$item_id));
		
		if(!$seo){  
			$model = new Seo;
			$model->controller = $controller;
			$model->action = $action;
			$model->item_id = $item_id;
			$model->save();
		}
	}

	public static function seoManagerDelete($controller, $action, $item_id)
	{ 
		Seo::model()->deleteAll(array('condition'=>'controller="'.$controller.'" AND action="'.$action.'" AND item_id="'.$item_id.'"'));
		
	}

	public static function display_seo(){
		$pageTitle = Yii::app()->name;
		$pageDescription = Yii::app()->name;
		
		if(isset($_GET['id'])){
			$meta = Seo::model()->findByAttributes(array('controller'=>Yii::app()->controller->id, 'action'=>Yii::app()->controller->action->id, 'item_id'=>$_GET['id']));
			if($meta){
				$pageTitle = $meta->title;
				$pageDescription = $meta->description;
			}
		}
		
    echo PHP_EOL.'<meta name="description" content="'.CHtml::encode($pageDescription).'">'.PHP_EOL;
		echo '<title>'.CHtml::encode($pageTitle).'</title>'.PHP_EOL;
	}
	

	
	
	
}
?>