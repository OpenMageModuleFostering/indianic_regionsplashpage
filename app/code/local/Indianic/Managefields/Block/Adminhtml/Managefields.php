<?php
class Indianic_Managefields_Block_Adminhtml_Managefields extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_managefields';
    $this->_blockGroup = 'managefields';
    $this->_headerText = Mage::helper('managefields')->__('Fields Manager');
    $this->_addButtonLabel = Mage::helper('managefields')->__('Add Fields');
    parent::__construct();
  }
}