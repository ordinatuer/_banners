<?php

Yii::import('zii.widgets.CListView');

class BannersListView extends CListView
{
    public $itemView = array(1=>'_view_image',2=>'_view_flash',3=>'_view_html');
    /**
     * Renders the data item list.
     */
    public function renderItems()
    {
        echo CHtml::openTag($this->itemsTagName,array('class'=>$this->itemsCssClass))."\n";
        $data=$this->dataProvider->getData();
        if (($n=count($data))>0) {
            $owner=$this->getOwner();
            //$viewFile=$owner->getViewFile($this->itemView);
            $j=0;
            foreach ($data as $i => $item) {
                $data = $this->viewData;
                $data['index']=$i;
                $data['data']=$item;
                $data['widget']=$this;

                $viewFile=$owner->getViewFile($this->itemView[$item->type]);
                $owner->renderFile($viewFile,$data);
                if($j++ < $n-1)
                    echo $this->separator;
            }
        }
        else
            $this->renderEmptyText();
        echo CHtml::closeTag($this->itemsTagName);
    }
}