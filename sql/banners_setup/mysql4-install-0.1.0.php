<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('banners')};
CREATE TABLE {$this->getTable('banners')} (
  `banners_id` int(11) unsigned NOT NULL auto_increment,
  `area` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `subtitle` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `filename_responsive` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `start_at` datetime NULL,
  `end_at` datetime NULL,
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`banners_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->endSetup(); 