<?php

class Indianic_Regionpage_Model_Mysql4_Regionpage extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the regionpage_id refers to the key field in your database table.
        $this->_init('regionpage/regionpage', 'regionpage_id');
    }
}