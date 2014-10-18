<?php

Yii::import('bootstrap.widgets.TbGridView');

class TGridView extends TbGridView
{
    public $selectPageSizeCssClass = 'page-size';

    public static $nextPageSize = array(10=>25,25=>10);

    public static function validatePageSize($ps)
    {
        return is_numeric($ps) && array_key_exists($ps, self::$nextPageSize);
    }

    public function renderSelectPageSize()
    {
        $currentPageSize = $this->dataProvider->getPagination()->pageSize;

        $url = array($this->controller->route) + $_GET;
        $url['pageSize'] = self::$nextPageSize[$currentPageSize];

        echo '<div id="grid-extend">';
        echo CHtml::link('show ' . self::$nextPageSize[$currentPageSize] . ' items',
            $url,
            array('id'=>$this->selectPageSizeCssClass)
        );
        echo '</div>';
    }

    public function renderSummary()
    {
        if (($count=$this->dataProvider->getItemCount())<=0)
            return;

        echo '<div class="'.$this->summaryCssClass.'">';
        if ( $this->enablePagination ) {
            $pagination=$this->dataProvider->getPagination();
            if ( ($summaryText=$this->summaryText)===null ) {
                $summaryText = 'Page #: ' . ($pagination->currentPage + 1) . ' from ' . $pagination->pageCount;
            }

            echo $summaryText;
        } else {
            if ( ($summaryText=$this->summaryText)===null )
                $summaryText=Yii::t('zii','Total 1 result.|Total {count} results.',$count);
            echo strtr($summaryText,array(
                '{count}'=>$count,
                '{start}'=>1,
                '{end}'=>$count,
                '{page}'=>1,
                '{pages}'=>1,
            ));
        }
        echo '</div>';
    }

}

?>
