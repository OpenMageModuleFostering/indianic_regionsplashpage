<?php

class Indianic_Managefields_Model_Mysql4_Managefields_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('managefields/managefields');
    }
}