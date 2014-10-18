<?php
/* @var $this IbeaconController */
/* @var $model Ibeacon */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ibeacon_uuid'); ?>
		<?php echo $form->textArea($model,'ibeacon_uuid',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'minor'); ?>
		<?php echo $form->textField($model,'minor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'major'); ?>
		<?php echo $form->textField($model,'major'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'image'); ?>
		<?php echo $form->textField($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ibeacon_id'); ?>
		<?php echo $form->textField($model,'ibeacon_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->