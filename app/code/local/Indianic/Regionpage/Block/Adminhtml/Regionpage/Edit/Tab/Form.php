<?php

class Indianic_Regionpage_Block_Adminhtml_Regionpage_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('regionpage_form', array('legend'=>Mage::helper('regionpage')->__('Region information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('regionpage')->__('Title'),
          'name'      => 'title',
          'note'      => 'e.g. Country splash page',
      ));
      
       $fieldset->addField('url_key', 'text', array(
          'label'     => Mage::helper('regionpage')->__('Url Key'),
          'name'      => 'url_key',
          'note'      => 'Url key something like region name or country name suppose example is url key then on frontend it will be like  http://yourdomain.com/example.html',
      ));
      
          
        $collection = Mage::getModel('managefields/managefields')->getCollection()->addFieldToFilter('status',1);
        
      
        
        foreach($collection as $data)
        {
            $required = 0;
            $class = "";
            $type = $data->getType();
            $title = $data->getTitle();
            $required = $data->getRequired();
            
            if($required==1)
            {
                $required = true;
                $class = 'required-entry';
            }
            else
            {
                $required = false;
            }
             switch ($type) {
                 
                 case 'text' :
                 $fieldset->addField($title, 'text', array(
                 'label'     => Mage::helper('regionpage')->__(ucfirst($data->getTitle())),
                 'class'     => $class,
                 'required'  => $required,
                 'name'      => $title,
              ));
              break;
              case 'textarea' :
                 $fieldset->addField($title, 'textarea', array(
                 'label'     => Mage::helper('regionpage')->__(ucfirst($data->getTitle())),
                 'class'     => $class,
                 'required'  => $required,
                 'name'      => $title,
              ));
               break;
            }
        }
        $block = Mage::getModel('cms/block')->getCollection();
        $arr_b=array();
         $j=1;
         foreach($block as $collection){
                    $arr_b[$j]['value'] = $collection->getIdentifier();
                    $arr_b[$j]['label'] = $collection->getTitle();
                    $j++;
         }
         $fieldset->addField('static_block', 'select', array(
          'label'     => Mage::helper('regionpage')->__('Select static block'),
          'name'      => 'static_block',
          'note'      => 'Assign one of your static block for content',
          'values'    => $arr_b,
      ));
     
     
      if ( Mage::getSingleton('adminhtml/session')->getRegionpageData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getRegionpageData());
          Mage::getSingleton('adminhtml/session')->setRegionpageData(null);
      } elseif ( Mage::registry('regionpage_data') ) {
          $form->setValues(Mage::registry('regionpage_data')->getData());
      }
      return parent::_prepareForm();
  }
}