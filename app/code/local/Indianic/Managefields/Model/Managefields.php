<?php

class Indianic_Managefields_Model_Managefields extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('managefields/managefields');
    }
}