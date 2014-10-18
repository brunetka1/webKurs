<?php
/* @var $this IbeaconController */
/* @var $data Ibeacon */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ibeacon_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ibeacon_id), array('view', 'id'=>$data->ibeacon_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ibeacon_uuid')); ?>:</b>
	<?php echo CHtml::encode($data->ibeacon_uuid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minor')); ?>:</b>
	<?php echo CHtml::encode($data->minor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('major')); ?>:</b>
	<?php echo CHtml::encode($data->major); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />


</div>