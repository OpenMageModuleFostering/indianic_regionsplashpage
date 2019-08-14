<?php

class Indianic_Regionpage_Block_Adminhtml_Regionpage_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'regionpage';
        $this->_controller = 'adminhtml_regionpage';
        
        $this->_updateButton('save', 'label', Mage::helper('regionpage')->__('Save Region'));
        $this->_updateButton('delete', 'label', Mage::helper('regionpage')->__('Delete Region'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('regionpage_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'regionpage_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'regionpage_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('regionpage_data') && Mage::registry('regionpage_data')->getId() ) {
            return Mage::helper('regionpage')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('regionpage_data')->getTitle()));
        } else {
            return Mage::helper('regionpage')->__('Add Item');
        }
    }
}