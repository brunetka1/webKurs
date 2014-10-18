<fieldset>
    <legend>Ibeacon Create</legend>

    <?php /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'   => 'horizontalForm',
            'type' => 'horizontal',
        ));
    ?>
    
    <?php echo $form->textFieldRow($model, 'ibeacon_id',array('class' => 'span3',)); ?>

    <?php echo $form->textFieldRow($model, 'ibeacon_uuid',array('class' => 'span3',)); ?>

    <?php echo $form->textFieldRow($model, 'minor',array('class' => 'span3',)); ?>

    <?php echo $form->textFieldRow($model, 'major', array('class' => 'span3',)); ?>

    <?php echo $form->textFieldRow($model, 'title',array('class' => 'span3',)); ?>
    <?php echo $form->textAreaRow($model, 'message',array('class' => 'span3','rows' => 3)); ?>
    <?php echo $form->textFieldRow($model, 'image',array('class' => 'span3',)); ?>

    <div class='form-actions'>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'info',
            'label'      => 'Create',
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'reset',
            'type'       => 'primary',
            'label'      => 'Reset ',
            'size'       => 'null',
            ));
        
         ?>
          <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Cancel',
                    'type' => 'action',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#cancelModal',
                    ),
                )); ?>

    

        <?php $this->endWidget(); ?>
        <?php $this->renderPartial('/ibeacon/_cancel'); ?>
    </div>
</fieldset>

	



