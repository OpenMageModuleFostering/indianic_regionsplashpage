<?php
class Indianic_Managefields_Block_Managefields extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getManagefields()     
     { 
        if (!$this->hasData('managefields')) {
            $this->setData('managefields', Mage::registry('managefields'));
        }
        return $this->getData('managefields');
        
    }
}