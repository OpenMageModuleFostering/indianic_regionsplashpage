<?php

class Indianic_Managefields_Block_Adminhtml_Managefields_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('managefields_form', array('legend'=>Mage::helper('managefields')->__('Fields information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('managefields')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
     /* if($this->getRequest()->getParam('id'))
      {
         
          $model  = Mage::getModel('managefields/managefields')->load($this->getRequest()->getParam('id'));
          $title = $model->getTitle();
      }
      else
      {
          $title = "";
      }
         $fieldset->addField('hidden', 'hidden', array(
          'label'     => Mage::helper('managefields')->__('Title'),
          'value'     => $title,
          'name'      => 'hidden',
      ));      */
        
      
       $fieldset->addField('type', 'select', array(
          'label'     => Mage::helper('managefields')->__('Input Type'),
          'name'      => 'type',
          'values'    => array(
              array(
                  'value'     => 'text',
                  'label'     => Mage::helper('managefields')->__('Text'),
              ),

              array(
                  'value'     => 'textarea',
                  'label'     => Mage::helper('managefields')->__('Textarea'),
              ),
          ),
      ));
      
      
      $fieldset->addField('required', 'select', array(
          'label'     => Mage::helper('managefields')->__('Required'),
          'name'      => 'required',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('managefields')->__('Yes'),
              ),

              array(
                  'value'     => 0,
                  'label'     => Mage::helper('managefields')->__('No'),
              ),
          ),
      ));
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('managefields')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('managefields')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('managefields')->__('Disabled'),
              ),
          ),
      ));
      
      if ( Mage::getSingleton('adminhtml/session')->getManagefieldsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getManagefieldsData());
          Mage::getSingleton('adminhtml/session')->setManagefieldsData(null);
      } elseif ( Mage::registry('managefields_data') ) {
          $form->setValues(Mage::registry('managefields_data')->getData());
      }
      return parent::_prepareForm();
  }
}