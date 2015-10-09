<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Welcome to Home Library</title>

    <meta name="description" content="..." />
    <meta name="keywords" content="..." />


        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/nivo-slider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom-nivo-slider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.fancybox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/jquery-ui-1.10.4/css/custom/jquery-ui-1.10.4.custom.css" />
    <?php Yii::app()->clientScript->registerCoreScript('jquery');
         Yii::app()->clientScript->registerCoreScript( 'jquery.ui' );
    ?>

    <?php Yii::app()->clientScript->registerScript("VarList", 'save_filter_url = "'.$this->createUrl('/site/saveFilters').'";
																														 login = window.location.href;
																														 createComment = "'.$this->createUrl('/bookInfo/createComment').'";
																														 createCommentToComment = "'.$this->createUrl('/bookInfo/createCommentToComment').'";
																														 setCommentToCommentLike = "'.$this->createUrl('/bookInfo/setCommentToCommentLike').'";
																														 setCommentLike = "'.$this->createUrl('/bookInfo/setCommentLike').'";
																														 setRate="'.$this->createUrl('/bookInfo/setRate').'";
																														 loadComments="'.$this->createUrl('/bookInfo/loadComments').'";
																														 ',CClientScript::POS_HEAD); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.deserialize.min.js',CClientScript::POS_HEAD);?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.nivo.slider.pack.js',CClientScript::POS_HEAD); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.fancybox.pack.js',CClientScript::POS_HEAD); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.easing.pack.js',CClientScript::POS_HEAD); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/DD_belatedPNG.js',CClientScript::POS_HEAD); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/filter.js',CClientScript::POS_HEAD); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/custom.js',CClientScript::POS_HEAD); ?>

</head>




<body>

<div id="bgc">
<?php $this->renderPartial("/index/_top_status_bar")?>

    <div class="wrapper">		<!-- wrapper begins -->






        <div id="header">
            <h1><a href="<?=$this->createUrl('index/index')?>"><span>Blur Studio</span></a></h1>

            <ul>
                <li><a type="changing" href="" ><?=Yii::t('trans','Book changing')?></a></li>
                <li><a type="search"  href=""><?=Yii::t('trans','Pick me book')?></a></li>
                <li><a type="about"  href=""><?=Yii::t('trans','About us')?></a></li>

                <!--<li><a href="index.html">Blog</a></li>
                <li><a href="index.html">Contact</a></li>-->
            </ul>
        </div>		<!-- #header ends -->






<?php echo $content?>





        <div id="footer">
            <p class="left"><a href="#"><span>Home Library</span></a></p>
            <p class="right">&copy; 2015.</p>
        </div>		<!-- #footer ends -->



    </div>		<!-- wrapper ends -->


</div>






</body>
</html>