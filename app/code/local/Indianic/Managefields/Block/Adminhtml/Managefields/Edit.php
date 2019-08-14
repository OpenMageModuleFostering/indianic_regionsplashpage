<?php

class Indianic_Managefields_Block_Adminhtml_Managefields_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'managefields';
        $this->_controller = 'adminhtml_managefields';
        
        $this->_updateButton('save', 'label', Mage::helper('managefields')->__('Save Fields'));
        $this->_updateButton('delete', 'label', Mage::helper('managefields')->__('Delete Fields'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('managefields_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'managefields_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'managefields_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('managefields_data') && Mage::registry('managefields_data')->getId() ) {
            return Mage::helper('managefields')->__("Edit Fields '%s'", $this->htmlEscape(Mage::registry('managefields_data')->getTitle()));
        } else {
            return Mage::helper('managefields')->__('Add Fields');
        }
    }
}