<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>

    <div class='modal-header'>
        <a class='close' data-dismiss='modal'>&times;</a>
        <h4>Warning!</h4>
    </div>

    <div class='modal-body'>
        <p>Are you sure you want to delete this ibeacon?</p>
    </div>

    <div class='modal-footer'>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'primary',
            'label'=>'OK',
            'url'=>'#',
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Close',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>
    </div>

<?php $this->endWidget(); ?>
