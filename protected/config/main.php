<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Home library',
  'theme'=>'classic',
  'sourceLanguage' => 'always-take-translations-from-database',
	'charset'=>'utf-8',
	'preload'=>array('log'),

	'import'=>array(
		'application.models.*',
		'application.components.*',
    'ext.bootstrap.*',
    'ext.x-editable.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
			'ipFilters'=>array('10.0.2.49','::1','*'),
		),
	),

  'language'=>'en',
  'defaultController' => 'index',
	'components'=>array(
		'user'=>array(
       
      'loginUrl'=>array('index/index'),
      'allowAutoLogin'=>true,
      'authTimeout' => 86400*7,
      'autoRenewCookie'=>true,
      'stateKeyPrefix'=>'HL',
		),
    'session' => array(
      'timeout' => 86400*7,
    ),
    'coreMessages'=>array(
      'basePath'=>'protected/messages',
    ),
    'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),

    //X-editable config
    'editable' => array(
        'class'     => 'editable.EditableConfig',
        'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain'
        'mode'      => 'inline',            //mode: 'popup' or 'inline'
        'defaults'  => array(              //default settings for all editable elements
           'emptytext' => 'Click to edit'
        )
    ),
    'urlManager'=>array(
      'urlFormat'=>'path',
      'rules'=>array(
        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
//        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<controller:index>/<action:index>'=>'<controller>/<action>',

        array(
          'class' => 'application.components.FriendlyUrlRule',
          'connectionID' => 'db',
        ),

      ),
      'showScriptName'=>false,
    ),

    'widgetFactory'=>array(
      'widgets'=>array(
        'CGridView'=>array(
          'cssFile'=>false,
        ),
        'CDetailView'=>array(
          'cssFile'=>false,
        ),
        'CLinkPager'=>array(
          'cssFile'=>false,
        ),
        'CListView'=>array(
          'cssFile'=>false,
        ),
        'CJuiButton'=>array(
          'cssFile'=>false,
        ),
        'CJuiAutoComplete'=>array(
          'cssFile'=>false,
        ),
      ),
    ),

    'clientScript' => array(
     // 'scriptMap' => require(dirname(__FILE__).'/ui_map.php'),
    ),

//    'db'=>require(dirname(__FILE__).'/db.php'),

    'errorHandler'=>array(
      'errorAction'=>'index/error',
    ),
  ),

  'params'=> array(
    'pageSize' => 20,
    'viewPageSize'=>20,
    'highLight'=>'#0B75B2',
    'adminEmail'=>'vetalpirko@gmail.com',
    //'adminEmail'=>'marina.savelova@pkp.vn.ua',
  ),
);

$localConfig = array();

$localConfigFile = dirname(__FILE__) . '/main-local.php';
if (file_exists($localConfigFile)) {
        $localConfig = require_once($localConfigFile);
}

return CMap::mergeArray($config, $localConfig);

