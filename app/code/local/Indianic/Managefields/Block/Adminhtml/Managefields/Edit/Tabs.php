<?php

class Indianic_Managefields_Block_Adminhtml_Managefields_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('managefields_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('managefields')->__('Fields Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('managefields')->__('Fields Information'),
          'title'     => Mage::helper('managefields')->__('Fields Information'),
          'content'   => $this->getLayout()->createBlock('managefields/adminhtml_managefields_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}