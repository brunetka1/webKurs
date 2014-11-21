<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name;
?>

<div class='wrp'>
    <div class='span7 offset2'>
        <div class='panel panel-warning'>
            <div class='panel-heading'>
                <h3 class='panel-title'>Warning Message</h3>
            </div>
            <div class='panel-body'>
                <p class='lead text-center'>System allows only 50 users to be logged in.</p>
            </div>
            <div class='panel-footer'>
                <p class='text-center'> Please <?= CHtml::link('try again', array('site/login')); ?> later.
                    Sorry for inconvenience.
                </p>
            </div>
        </div>
    </div>
</div>