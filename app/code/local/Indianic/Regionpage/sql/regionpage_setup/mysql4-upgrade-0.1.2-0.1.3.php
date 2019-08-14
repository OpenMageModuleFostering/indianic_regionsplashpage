<?php

$installer = $this;

 Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
 
$staticBlock = array(
                'title' => 'Region Page Block',
                'identifier' => 'region-page',
                'is_active' => 1,
                'stores' => array(1)
                );
 
Mage::getModel('cms/block')->setData($staticBlock)->save();


$installer->endSetup();


