<p>This page is appointed for creating new and managing existing users</p>

<?php echo CHtml::link('Create New Order', array('customer/create')); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'search-form',
    'method'=>'GET',
)); ?>

<fieldset>
    <legend>Search
        <span>by</span>
    </legend>
    <div id='search-fields'>
        <div class="span12">
            <div class='span2'><p>Filter orders by:</p></div>
            <div class='span3'>
                <?php echo $form->dropDownlist($model, 'filterCriteria', $model->filterCriterias, array(
                    'class' => 'span3',
                    'options' => array(
                        array_search('Status', $model->filterCriterias) => array('selected' => true
                        )
                    ),
                    'ajax' => array(
                        'type' => 'Post',
                        'url' => $this->createUrl('customer/dependentselect'),
                        'update' => '#Order_filterValue',
                    ),
                ));
                ?>
            </div>
            <div class='span3'>
                <?php echo $form->dropDownlist($model, 'filterValue', $model->filterStatuses,
                    array('class' => 'span3',
                        'options' => array(
                            array_search('None', $model->filterStatuses) => array('selected' => true
                            )
                        ),
                    ));
                ?>
            </div>
        </div>
        <div class="span12">
            <div class='span2'>Search for orders by:</div>
            <div class='span3'>
                <?php echo $form->dropDownlist($model, 'searchCriteria', $model->searchCriterias,
                    array('class' => 'span3',
                        'options' => array(
                            array_search('Order Name', $model->searchCriterias) => array('selected' => true
                            )
                        )
                    ));
                ?>
            </div>
            <div class='span3'>
                <?php echo $form->textField($model, 'searchValue', array('class' => 'span3')); ?>
            </div>
            <div class='span2 pull-right'>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Apply',
                    'buttonType' => 'submit',
                    'type' => 'info',
                    'size' => 'null',
                ));?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Reset',
                    'buttonType' => 'ajaxButton',
                    'type' => 'primary',
                    'url' => '?r=customer/resetfilter',
                    'htmlOptions' => array(
                        'onclick' => 'js:onReset()',
                    ),
                    'ajaxOptions' => array(
                        'data' => 'reset',
                        'success' => 'js:function(response){$("#yw0").replaceWith($(response)).removeClass("grid-view-loading");return false;}',
                    ),

                )); ?>
                <?php echo CHtml::errorSummary($model) ?>
            </div>
        </div>
    </div>
</fieldset>
<?php $this->endWidget(); ?>

<?php $this->renderPartial('/customer/grid',  array('model' => $model,)); ?>

<?php $this->renderPartial('/customer/_delete'); ?>

<script>
    function onReset(){
        $('#yw0').addClass('grid-view-loading');
        $('#search-form')[0].reset();
    }

    function beforeRemove(el) {
        $('#modal_remove').attr('href', $(el).attr('href'));
    }

    $(function () {
        $('#modal_remove').click(function () {
            var url = $(this).attr('href');
            $.get(url, function (response) {
                $('.modal-header .close').click();
                $.fn.yiiGridView.update('yw0');
            });
            return false;
        });
    });



</script>
