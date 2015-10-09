<?php
$this->pageTitle=Yii::app()->name . ' - Error';
?>
<div class="clear"></div>
<p class="error_header">Error <?php echo $code; ?></p>

<div class="error error_message">
    <?php echo CHtml::encode($message); ?>
</div>