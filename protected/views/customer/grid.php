<?php
$grid = $this->widget('TGridView', array(
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'ajaxUpdate' => '',
    'updateSelector' => '{page}, {sort}, #page-size, .yiiPager',
    'filterSelector' => '{filter}',
    'template' => "{selectPageSize}\n{items}\n<div class=\"grid-footer\">{summary}{pager}</div>",
    'pager' => array(
        'class' => 'OmsPager',
        'header' => '',
        'maxButtonCount' => 0,
        'firstPageLabel' => '&lsaquo; First',
        'prevPageLabel' => '&larr; Backward',
        'nextPageLabel' => 'Forward &rarr;',
        'lastPageLabel' => 'Last &rsaquo;',
        'htmlOptions' => array(
            'class' => 'yiiPager',
        ),
        'cssFile' => 'css/pager.css',
    ),
    'pagerCssClass' => 'oms-pager',
    'baseScriptUrl' => 'gridview',
    'columns' => array(
        array('name' => 'order_name', 'header' => 'Order Name'),
        array(
            'name' => 'total_price',
            'value' => '(int)$data->total_price . "\$"',
        ),
        array(
            'name' => 'max_discount',
            'value' => '$data->max_discount.""."%"',
        ),
        array(
            'name' => 'delivery_date',
            'value' => '($data->delivery_date != "0000-00-00") ?
                Yii::app()->dateFormatter->format("MM/dd/yyyy",$data->delivery_date) : "Delivery Date not assigned";',
        ),
        'status',
        array(
            'name' => 'assignee',
            'value' => '$data->assignees->username',
        ),
        array(
            'name' => 'assigneesRole',
            'value' => '$data->assignees->role',

        ),
        array(
            'header' => 'Edit',
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{edit}',
            'htmlOptions' => array(),
            'buttons' => array(
                'edit' => array(
                    'icon' => 'edit large',
                    'url' => 'Yii::app()->createUrl(\'customer/edit\',array(\'id\'=>$data->id_order))',
                ),
            )
        ),
        array(
            'header' => 'Remove',
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{remove}',
            'htmlOptions' => array(
                'id' => 'col_remove',
            ),
            'buttons' => array(
                'remove' => array(
                    'icon' => 'remove large',
                    'url' => 'Yii::app()->createUrl(\'customer/remove\',array(\'id\'=>$data->id_order))',
                    'options' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#remove_order',
                        'onclick' => 'beforeRemove(this)',
                    ),
                ),
            )
        ),
    ),
));?>