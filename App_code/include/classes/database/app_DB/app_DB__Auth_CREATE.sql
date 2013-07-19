CREATE TABLE IF NOT EXISTS `Auth` (
  `username` varchar(64) NOT NULL,
  `password` varchar(64) default NULL,
  `user_ID` int(11) NOT NULL auto_increment,
  `user_type` smallint(6) default '0',
  `is_Logon` int(1) default '0',
  PRIMARY KEY  (`user_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;