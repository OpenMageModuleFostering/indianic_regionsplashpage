<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('regionpage')} ADD static_block varchar(255) NOT NULL default 'region-page';

");

$installer->endSetup();


