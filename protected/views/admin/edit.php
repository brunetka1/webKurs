<script>

    $(document).ready(function () {
        $('.password-group').hide();
       // $('#User_password').val('');
        $('.slide').click(function(){
            $('.password-group').slideToggle();
            return false;
        })
    });
</script>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                      => 'horizontalForm',
    'type'                    => 'horizontal',
    'enableClientValidation'  =>  true,
    'clientOptions'           =>  array(
        'validateOnSubmit'    =>  true
    )
)); ?>
        
            <?php echo $form->textFieldRow($model, 'username'); ?>
            <?php echo $form->textFieldRow($model, 'firstname'); ?>
            <?php echo $form->textFieldRow($model, 'lastname'); ?>

            <div class='row offset2 change-link' >
                <p> 
                    <a href='#' class='slide'>Change password</a>
                </p>
            </div>

            <div class='password-group'>
               <?php echo $form->passwordFieldRow($model, 'password', array(
                   'placeholder' => 'enter new password'));
               ?>
               <?php echo $form->passwordFieldRow($model, 'confirmPassword'); ?>
                <div class="controls password_buttons">
                    <input type="button" class="show_pass btn-info btn-mini" value="Show/Hide password"/>
                    <input type="button" class="generate_pass btn-info btn-mini" value="Generate "/>
                </div>
            </div>

            <?php echo $form->textFieldRow($model, 'email'); ?>
            
            <?php echo $form->dropDownListRow($model, 'region', array(
                'north' => 'North',
                'south' => 'South',
                'west'  => 'West',
                'east'  => 'East'
            )); ?>
            
            <?php echo $form->dropDownListRow($model, 'deleted', array(
                0 =>'Active',
                1 =>'Deleted',
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



