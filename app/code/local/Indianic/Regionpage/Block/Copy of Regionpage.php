<?php
class Indianic_Regionpage_Block_Regionpage extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
         $region = $region = $this->getValue();
        $head = $this->getLayout()->getBlock('head');
        $head->setTitle($region->getMetaTitle());
        $head->setKeywords($region->getMetaKeywords());
        $head->setDescription($region->getMetaDescription());
		return parent::_prepareLayout();
    }
    
     public function getRegionpage()     
     { 
        if (!$this->hasData('regionpage')) {
            $this->setData('regionpage', Mage::registry('regionpage'));
        }
        return $this->getData('regionpage');
        
    }
    public function getValue()
    {
            $id = $this->getRequest()->getParam('id');
            $region = Mage::getModel('regionpage/regionpage')->load($id);
            
            return $region;        
    }
    public function getStaticBlock()
    {
       $block = Mage::getModel('cms/block')
        ->setStoreId(Mage::app()->getStore()->getId())
        ->load('region-page');
        
        $array = array();
    
        
        $region = $this->getValue();
               
         $array['city'] = $region->getTitle();
         
         $array['address'] = $region->getAddress();
         
         $array['number'] = $region->getNumber();
         
         $filter = Mage::getModel('cms/template_filter');
         
         $filter->setVariables($array);
         
         return $filter->filter($block->getContent());
  }
}