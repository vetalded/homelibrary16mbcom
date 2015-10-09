<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'qa',
	// application components
        'import'=>array(
		'application.models.*',
		'application.components.*',
    'application.extensions.debugtoolbar.*',
	),
	'components'=>array(
		//'db'=>array(
		//	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		//),
		// uncomment the following to use a MySQL database
/*
			'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=aura',
			'emulatePrepare' => true,
			'username' => 'aura',
			'password' => '123',
			'charset' => 'utf8',
		          'enableParamLogging'=>true,
			'enableProfiling'=>true,
		),
*/
	),
);

$localConfig = array();

$localConfigFile = dirname(__FILE__) . '/console-local.php';
if (file_exists($localConfigFile)) {
        $localConfig = require_once($localConfigFile);
}

return CMap::mergeArray($config, $localConfig);

