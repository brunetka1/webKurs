

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'cancelModal')); ?>

<div class='modal-header'>
    <a class='close' data-dismiss='modal'>&times;</a>
    <h4>Warning</h4>
</div>

<div class='modal-body'>
    <p>Are you sure you want to cancel operation?</p>

</div>

<div class='modal-footer'>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Yes',
        'url' => $this->createUrl('ibeacon/admin'),
    ));
    ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'No',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>
    <?php $this->endWidget(); ?>

