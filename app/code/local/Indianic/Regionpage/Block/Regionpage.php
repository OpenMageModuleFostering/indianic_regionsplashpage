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
        
         $region = $this->getValue();
         
       $block = Mage::getModel('cms/block')
        ->setStoreId(Mage::app()->getStore()->getId())
        ->load($region->getStaticBlock());

        $array = array();
              
          $array['title'] = $region->getTitle();
          $array['meta_title'] = $region->getMetaTitle();
          $array['meta_keywords'] = $region->getMetaKeywords();
          $array['meta_description'] = $region->getMetaDescription();
          
         $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $result = $read->fetchAll("select title from managefields where status =1");
        
        foreach($result as $data)
        {  
           $data1 = get.ucfirst($data['title']);
            $array[$data['title']] = $region->$data1();
        }
        
                  
         $filter = Mage::getModel('cms/template_filter');
         
         $filter->setVariables($array);
         
         return $filter->filter($block->getContent());
  }
}