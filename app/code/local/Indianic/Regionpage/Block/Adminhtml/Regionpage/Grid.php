<?php

class Indianic_Regionpage_Block_Adminhtml_Regionpage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('regionpageGrid');
      $this->setDefaultSort('regionpage_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('regionpage/regionpage')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('regionpage_id', array(
          'header'    => Mage::helper('regionpage')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'regionpage_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('regionpage')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));
      
      $this->addColumn('url_key', array(
          'header'    => Mage::helper('regionpage')->__('Url Key'),
          'align'     =>'left',
          'index'     => 'url_key',
      ));
      
	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('regionpage')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

      /*$this->addColumn('status', array(
          'header'    => Mage::helper('regionpage')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));*/
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('regionpage')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('regionpage')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('regionpage_id');
        $this->getMassactionBlock()->setFormFieldName('regionpage');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('regionpage')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('regionpage')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('regionpage/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
      
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}