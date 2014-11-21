
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name; ?>

<div class='wrp'>
    <div class='span7 offset2'>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class='panel-title'>Warning Message</h3>
            </div>
            <div class="panel-body">
                <p class='lead text-center'>User credentials were entered incorrectly.
                    Page is locked for 10 minutes. Please try again later.
                </p>
            </div>
<!--            <div class="panel-footer"></div>-->
        </div>
    </div>
</div>
