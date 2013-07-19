<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$sql_code = <<<EOD
CREATE TABLE IF NOT EXISTS `sessions2` (
  `sesskey` varchar(64) NOT NULL default '',
  `expiry` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `expireref` varchar(259) default '',
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL default '0000-00-00 00:00:00',
  `sessdata` longtext,
  PRIMARY KEY  (`sesskey`),
  KEY `sess2_expiry` (`expiry`),
  KEY `sess2_expireref` (`expireref`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
EOD;
