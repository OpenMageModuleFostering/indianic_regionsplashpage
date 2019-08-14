<?php

class Indianic_Regionpage_Model_Regionpage extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('regionpage/regionpage');
    }
}