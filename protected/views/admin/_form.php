<?php
/* @var $this IbeaconController */
/* @var $model Ibeacon */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ibeacon_uuid'); ?>
		<?php echo $form->textArea($model,'ibeacon_uuid',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ibeacon_uuid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minor'); ?>
		<?php echo $form->textField($model,'minor'); ?>
		<?php echo $form->error($model,'minor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'major'); ?>
		<?php echo $form->textField($model,'major'); ?>
		<?php echo $form->error($model,'major'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->