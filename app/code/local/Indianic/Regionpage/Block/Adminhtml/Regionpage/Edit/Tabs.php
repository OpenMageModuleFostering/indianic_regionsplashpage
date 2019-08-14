<?php

class Indianic_Regionpage_Block_Adminhtml_Regionpage_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('regionpage_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('regionpage')->__('Region Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('regionpage')->__('Region Information'),
          'title'     => Mage::helper('regionpage')->__('Region Information'),
          'content'   => $this->getLayout()->createBlock('regionpage/adminhtml_regionpage_edit_tab_form')->toHtml(),
      ));
     
    $this->addTab('tabid', array(
            'label'     => Mage::helper('regionpage')->__('Meta Data'),
            'class'     => 'ajax',
            'url'       => $this->getUrl('*/*/customgrid', array('_current' => true)),
        ));
      return parent::_beforeToHtml();
  }
}