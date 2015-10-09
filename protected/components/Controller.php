<?php

class Controller extends CController
{

    public $layout='//layouts/column2';

	public $menu=array();

	public $breadcrumbs=array();


  public function beforeAction($action){
    parent::beforeAction($action);

      if(Yii::app()->Controller->action->id!='index'){

        if(Yii::app()->user->getState('__type')!=1){
            $this->redirect('/admin/index');
        }
      }
    return true;
  }
}