<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/grid.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/breadcrumbs.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/flash.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/load_img.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/pager.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rights.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/slider.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/button.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/classic/jquery-ui-1.9.1.custom.css" />

  
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/images/bi-144.png" /> 
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/bi-114.png" /> 
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/bi-72.png" /> 
  <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->request->baseUrl; ?>/images/bi-57.png" />
  
	<?php Yii::app()->clientScript->registerCoreScript('jquery');	?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/functions.js?rnd='.rand(10000000,99999999),CClientScript::POS_END);	?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/click.js?rnd='.rand(10000000,99999999),CClientScript::POS_END); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.scrollTo-1.4.3.1-min.js',CClientScript::POS_END); ?>
	<?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/bootstrap.min.js',CClientScript::POS_END); ?>

</head>
<body>
	<div class="container" id="page">
		<div id="header"></div>
	 
		<div id="main_menu">
		<?php if(isset($this->breadcrumbs)){ ?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'homeLink'=>false,
				'links'=>array_merge( array(Yii::t('trans','Main menu')=>array('admin/menu')),$this->breadcrumbs),
			)); ?><!-- breadcrumbs -->
		<?php } ?>

		<?php
			if(!Yii::app()->user->isGuest){
				echo "<div id='exit' title='".Yii::t('trans','Exit')."'>".CHtml::link("<img src='".Yii::app()->request->baseUrl."/images/exit.png"."'>", Yii::app()->createUrl("admin/logout"))."</div>";
				echo "<div id='site'>".Yii::app()->user->getState('uname')."</div>";
			}
			?>
		</div><!-- main_menu -->
		
		<?php 
		if(Yii::app()->user->hasFlash('error')){
				echo "<div class='flash-error'>";
				echo Yii::app()->user->getFlash('error');
				echo "</div>";
			}
			
			if(Yii::app()->user->hasFlash('success')){
				echo "<div class='flash-success'>";
				echo Yii::app()->user->getFlash('success');
				echo "</div>";
			}
			
			if(Yii::app()->user->hasFlash('notice')){
				echo "<div class='flash-notice'>";
				echo Yii::app()->user->getFlash('notice');
				echo "</div>";
			}
		?>

		<div class="clear"></div>
        <?php if(isset($this->menu)){ ?>
            <?php $this->widget('zii.widgets.CMenu', array(

                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'menu'),
            )); ?><!-- breadcrumbs -->
        <?php } ?>
		<?php echo $content; ?>
	 
		<div class="clear"></div>
	  
		<div id="footer">
			<div class="fleft"> &copy; <?=Yii::app()->name;?> <?=date('Y');?></div>
			<div class="fright"><?php echo CHtml::link("Internet Studio Aura", "http://aura.vn.ua",array('target'=>'_blank'));?> <?=CHtml::image(Yii::app()->request->baseUrl."/images/yii.ico", "");?><?=CHtml::link("Powered By Yii", "http://www.yiiframework.com/", array("target"=>"_blank"));?> </div>
			<div class="clear"></div>
		</div><!-- footer -->
	</div><!-- page -->
</body>
</html>
