<?php
class Indianic_Regionpage_Block_Adminhtml_Regionpage extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_regionpage';
    $this->_blockGroup = 'regionpage';
    $this->_headerText = Mage::helper('regionpage')->__('Region Manager');
    $this->_addButtonLabel = Mage::helper('regionpage')->__('Add Region');
    parent::__construct();
  }
}