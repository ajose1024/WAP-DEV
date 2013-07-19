CREATE TABLE sessions2(
	  sesskey VARCHAR( 64 ) NOT NULL DEFAULT '',
  	  expiry DATETIME NOT NULL ,
	  expireref VARCHAR( 250 ) DEFAULT '',
	  created DATETIME NOT NULL ,
	  modified DATETIME NOT NULL ,
	  sessdata LONGTEXT,
	  PRIMARY KEY ( sesskey ) ,
	  INDEX sess2_expiry( expiry ),
	  INDEX sess2_expireref( expireref )