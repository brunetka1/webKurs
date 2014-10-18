<?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'horizontalForm',
        'type'                   => 'horizontal',
        'enableClientValidation' => true,
        'clientOptions'          => array(
            'validateOnSubmit'   =>  true
            )
        ));
?>

        <?php echo $form->textFieldRow($model, 'username'); ?>

        <?php echo $form->textFieldRow($model, 'firstname'); ?>

        <?php echo $form->textFieldRow($model, 'lastname'); ?>

        <?php echo $form->passwordFieldRow($model, 'password', array(
            'title' => '',
            'placeholder' => 'enter new password'));
        ?>

        <?php echo $form->passwordFieldRow($model, 'confirmPassword'); ?>
        <div class="controls password_buttons">
            <input type="button" class="show_pass btn-info btn-mini" value="Show/Hide password"/>
            <input type="button" class="generate_pass btn-info btn-mini" value="Generate "/>
        </div>

        <?php echo $form->textFieldRow($model, 'email'); ?>

        <?php echo $form->dropDownListRow($model, 'region', array(
            'north' => 'North',
            'south' => 'South',
            'west'  => 'West',
            'east'  => 'East'
        )); ?>

    <fieldset>
        <legend>Role</legend>

        <?php echo $form->radioButtonList($model, 'role', array(
            'admin'        => 'Administrator',
            'merchandiser' => 'Merchandiser',
            'supervisor'   => 'Supervisor',
            'customer'     => 'Customer',
        )); ?>
    </fieldset>

<input class="submit-handler" type="submit" style="display:none;"/>

<?php $this->endWidget(); ?>
<?php $this->renderPartial('_password');?>


