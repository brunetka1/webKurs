<?php
  //  $this->renderPartial('_modal-confirm-delete');
    //$this->renderPartial('_modal-edit');
?>

<p>This page is appointed for creating new and managing existing users</p>
<div style="display:none" id="base-url"><?php 
   // echo Yii::app()->getUrlManager()->getBaseUrl();
?></div>
<?php
echo CHtml::link('Create New User', array('admin/create'), array('id' => 'create-user'));

/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'                     => 'search-form',
    'enableClientValidation' => true,
    'type'                   => 'inline',
    'clientOptions'          => array(
        'validateOnSubmit'   => true,
    ),
    'htmlOptions' => array(
        'class'   => '',
    )
)); 
?>

<fieldset>
    <legend>Search 
        <span>by</span>
    </legend>
    <div class='span12'>
        <p>Field Filter</p>
    </div>
    <div class='control-group'>
        <div class='controls'>
            <div class='span4'>
                <?php echo $form->dropDownListRow($fields, 'keyField',
                    $fields->keyFields,
                    array('class' => 'input-xlarge',
                    ));
                ?>
            </div>
            <div class='span4'>
                <?php echo $form->dropDownListRow($fields, 'criteria',
                    $fields->criterias,
                    array('class' => 'input-xlarge',
                    ));
                ?>
            </div>
            <div class='row'>
                <div class='span4'>
                    <div class='input-append'>
                        <?php echo $form->textField($fields, 'keyValue', array(
                            'class' => 'span2',
                            'placeholder' => 'Search'
                        )); ?>
                        <button class='btn btn-info' type='submit' disabled='true' id='btn-search'>Search</button>
                        <button class="btn" type="reset">Reset</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<?php $this->endWidget(); ?>

<div class='wrp1'>
    <div class='row'>        
        <?php $dataProvider = $model->search(); ?>
        <div class='span4'>
            <div id='search-result'>Number of Found Users
                <div class='pull-right'>
                    <i class='icon-user icon-large'></i>
                    <span id='search-result-count'><?= $dataProvider->getTotalItemCount(); ?></span>
                </div> 
            </div>
        </div>
        <div class='span8'>
             <div class='metrouicss pull-right'>
                <form> 
                   
                    <label class='input-control switch'>hide
                        <input type='checkbox'  id='check_toggle'>
                        <span class='helper'>show</span>
                    </label> 
                    <p>deleted users</p>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="oms-grid-view0" class="grid-view">
    <div id="grid-extend"><a id="page-size">show 25 items</a></div>
    <table class="items table table-striped table-bordered table-condensed" id="table-user">
    <thead><tr>
        <th id="oms-grid-view0_c0">
            <a class="sort-link">User Name<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c1">
            <a class="sort-link">First Name<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c2">
            <a class="sort-link">Last Name<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c3">
            <a class="sort-link">Role<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c4">
            <a class="sort-link">Email<span class="caret"></span></a>
        </th>
        <th id="oms-grid-view0_c5">
            <a class="sort-link">Region<span class="caret"></span></a>
        </th>
        <th class="button-column" id="oms-grid-view0_c6">Edit</th>
        <th class="button-column" id="oms-grid-view0_c7">Remove</th>
        <th class="button-column" id="oms-grid-view0_c8">Duplicate</th>
    </tr></thead>
    </table>
    <div class="grid-footer">
        <div class="summary">Page # : </div>
        <div class="oms-pager">
            <ul class="plainPager">
                <li class="first hidden">First</li>
                <li class="backward hidden">Backward</li>
                <li class="forward hidden">Forward</li>
                <li class="last hidden">Last</li>
            </ul>
        </div>
    </div>
</div>
<?php
    $cs=Yii::app()->getClientScript();
    $baseUrl = Yii::app()->getBaseUrl();
//    $cs->registerCssFile($baseUrl . '/css/pager.css');

    $cs->registerCoreScript('jquery');
    $cs->registerCoreScript('bbq');

    $cs->registerScriptFile($baseUrl . '/js/underscore.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/js/backbone_002.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/js/user.js', CClientScript::POS_END);

    $cs->registerScript('1','
        oms.users.reset(' . $this->prepareAjaxData($dataProvider) . ');
    ');

?>
<script type="text/template" id="row-template">
    <td> <%= username %> </td>
    <td> <%= firstname %> </td>
    <td> <%= lastname %> </td>
    <td> <%= role %> </td>
    <td> <%= email %> </td>
    <td> <%= region %> </td>
    <td class="button-column">
        <a title="edit" rel="tooltip" href= <%= '"' + root + '/edit/id/' + id + '"' %> >
            <i class="icon-edit icon-large">
    </i></a></td>
    <td class="remove" >
        <%= 
            ( deleted==1 ) ? 
            ('<a rel="tooltip" title="deleted user">&times;</a>') : 
            (
                ( active ) ? 
                ('<a rel="tooltip" title="active user"><i class="icon-remove icon-large"></i></a>') : 
                ('<a rel="tooltip" title="remove" href="' + root + '/remove/id/' 
                    + id + '"><i class="icon-remove icon-large"></i></a>' )
            )
        %>
    </td>
    <td class="button-column">
        <a title="duplicate" rel="tooltip" href= <%= '"' + root + '/duplicate/id/'+id+'"' %> >
            <i class="icon-copy icon-large">
    </i></a></td>

</script>
