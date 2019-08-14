<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('managefields')} ADD   type varchar(255) NULL AFTER title;
ALTER TABLE {$this->getTable('managefields')} ADD   required varchar(255) NULL AFTER type;
	
");

$installer->endSetup();


