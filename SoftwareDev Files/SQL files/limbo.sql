
DROP DATABASE IF EXISTS site_db ;
CREATE DATABASE site_db ;
USE site_db ;  

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
		usersID				INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		username			varchar (40) NOT NULL,
		pass				CHAR (40) NOT NULL
	);

DROP TABLE IF EXISTS limbostuff;
CREATE TABLE IF NOT EXISTS limbostuff (
		stuffID			INT AUTO_INCREMENT PRIMARY KEY,
		usertype		SET ("Owner", "Finder") NOT NULL,
		contact         VARCHAR (60) NOT NULL, 
		location        CHAR(60) NOT NULL, 
		description 	VARCHAR (60) NOT NULL,
		limbodate		DATE NOT NULL,
		status 			SET ("found", "lost", "claimed") NOT NULL
	
	);

	
INSERT INTO users (username, pass)
VALUES ("admin", "gaze11e");	
	
		
		
INSERT INTO limbostuff (description, limbodate, usertype, status)
VALUES 	("alienware laptop" , '2013-03-02 ', "owner", "lost"),
		("alienware laptop" , '2013-04-12 ', "finder", "found"),
		("alienware laptop" , '2013-05-02 ', "owner", "claimed"),
		("northface coat" , '2014-01-03 ', "owner", "lost"),
		("black iphone" , '2014-01-03 ', "owner", "lost"),
		("nike sneakers" , '2014-01-03 ',  "finder", "found"),
		("apple laptop" , '2013-03-02 ', "owner", "lost"),
		("apple laptop" , '2013-03-02 ',  "owner", "found"),
		("apple laptop" , '2013-03-02 ', "owner", "claimed");
		