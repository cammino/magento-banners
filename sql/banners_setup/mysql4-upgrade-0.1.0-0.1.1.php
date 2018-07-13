<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('banners')} 
 ADD `categories` varchar(255) NULL AFTER filename_responsive");

$installer->endSetup(); 