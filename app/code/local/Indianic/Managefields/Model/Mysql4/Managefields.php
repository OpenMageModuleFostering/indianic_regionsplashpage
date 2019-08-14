<?php

class Indianic_Managefields_Model_Mysql4_Managefields extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the managefields_id refers to the key field in your database table.
        $this->_init('managefields/managefields', 'managefields_id');
    }
}