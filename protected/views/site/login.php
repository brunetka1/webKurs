
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>



<div class='wrp'>
    <div class="span6 offset3">
        <?php /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'                     => 'login-form',
            'type'                   => 'horizontal',
            'enableClientValidation' => true,
            'clientOptions'          => array(
                'validateOnSubmit'   => true,
                'afterValidate'      => new CJavaScriptExpression('function(form, data, hasError) {
                if ( !hasError ) {
                    form.on("submit", function(e) {
                        $("button", this).attr("disabled", true);
                    });
                }
                return true;
            }'),
            ),
            'htmlOptions' => array(
                'class'   => '',
            ),
        )); ?>

        <div class='panel panel-default'>
            <div class='panel-heading'>
                <legend class='panel-title'>Shop menegment</legend>
            </div>
            <div class='panel-body'>
                <div class="row">
                    <?php echo $form->textFieldRow($model, 'username', array(
                        'class' => 'input-xlarge',
                        'prepend' => '<i class="icon-user icon-large"></i>'
                    )); ?>

                    <?php echo $form->passwordFieldRow($model, 'password', array(
                        'class' => 'input-xlarge',
                        'prepend' => '<i class="icon-key icon-large"></i>'
                    )); ?>

                    <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
                </div>
            </div>
            <div class='panel-footer'>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'  => 'submit',
                    'type'        => 'success',
                    'label'       => 'sign in',
                    'block'       => 'true',   
                )); ?>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>