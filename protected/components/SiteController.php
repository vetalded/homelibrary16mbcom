<?php

class SiteController extends CController
{

	public $layout='//layouts/index';
	
	public $menu=array();
	
	public $breadcrumbs=array();
  
  public function beforeAction($action){
    parent::beforeAction($action);

    return true;
  }
}