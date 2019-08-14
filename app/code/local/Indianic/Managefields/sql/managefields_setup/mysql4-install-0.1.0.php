<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('managefields')};
CREATE TABLE {$this->getTable('managefields')} (
  `managefields_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
   `status` smallint(6) NOT NULL default '0',
   PRIMARY KEY (`managefields_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 