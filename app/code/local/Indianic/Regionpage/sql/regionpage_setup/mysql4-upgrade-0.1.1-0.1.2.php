<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('regionpage')} ADD url_key varchar(255) NULL AFTER title;

");

$installer->endSetup();


