<?php
/* @var $books Array */
/* @var $books[0]$data Books */
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />
<style>
    <?php for($i=0;$i<=100;$i++){?>
        .stars_all[rate="<?=$i?>"]{
        width: <?=$i?>px;
    }
    <?php }?>

</style>
<div id="holder">





    <div id="slideshow" style="display: none">
        <?php foreach ($books as $key=> $data) {?>
            <a href="<?=$this->createUrl('bookInfo/about',array('id'=>$data->id))?>">
                <img src="<?=empty($data->ext1)?Yii::app()->request->baseUrl."/images/no_image.png":Yii::app()->request->baseUrl."/images/books/".$data->id."_1.".$data->ext1?>" alt="" title="<div class='stars_none'><div class='stars_all' rate=<?=$data->rate?> ></div></div>" />
                <div class="book-slider-description" >

                    <table class="book-slider-about">
                        <tr>
                            <th>
                                <?=Yii::t("trans","Name")?>
                            </th>
                            <td>
                                <?=$data->name?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=Yii::t("trans","Author")?>
                            </th>
                            <td>
                                <?=$data->author->name?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=Yii::t("trans","Year")?>
                            </th>
                            <td>
                                <?=$data->year?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=Yii::t("trans","Genre")?>
                            </th>
                            <td>
                                <?=$data->genre?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=Yii::t("trans","Description")?>
                            </th>
                            <td>
                                <?=UserFunctions::shorten($data->description,260)?>
                            </td>
                        </tr>

                    </table>
                </div>
            </a>
        <?php }?>
        <?php $url?>

</div>		<!-- #slideshow ends -->

    <div id="slideshowbtm"></div>



    <div id="content" class="homepage">




        <div id="main">
                <?Yii::t('trans','main_information')?>
    </div>		<!-- #main ends -->








<div id="side">

        </div>		<!-- #side ends -->








        <div id="services">



        </div>		<!-- #services ends -->







    </div>		<!-- #content ends -->




</div>		<!-- #holder ends -->