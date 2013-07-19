CREATE TABLE Auth
    (username VARCHAR(64) NOT NULL,
     password VARCHAR(64),
     user_ID INT NOT NULL AUTO_INCREMENT,
     user_type SMALLINT DEFAULT 0 ,
     is_Logon BIT(1) DEFAULT b'0',
     PRIMARY KEY (user_ID)
    );
