<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('regionpage')} ADD   meta_title varchar(255) NULL AFTER title;
ALTER TABLE {$this->getTable('regionpage')} ADD   meta_keywords text NULL AFTER meta_title;
ALTER TABLE {$this->getTable('regionpage')} ADD   meta_description text NULL AFTER meta_keywords;

	
");

$installer->endSetup();


