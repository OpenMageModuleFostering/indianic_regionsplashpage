<?php

class Indianic_Regionpage_Block_Adminhtml_Regionpage_Edit_Tab_Metadata extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('regionpage_form', array('legend'=>Mage::helper('regionpage')->__('Meta information')));
     
      $fieldset->addField('meta_title', 'text', array(
          'label'     => Mage::helper('regionpage')->__('Meta Title'),
          'name'      => 'meta_title',
      ));
      
      $fieldset->addField('meta_keywords', 'textarea', array(
          'label'     => Mage::helper('regionpage')->__('Meta Keywords'),
          'name'      => 'meta_keywords',
      ));
      
      $fieldset->addField('meta_description', 'textarea', array(
          'label'     => Mage::helper('regionpage')->__('Meta Description'),
          'name'      => 'meta_description',
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