/* 
Presidents of the United States
Author: Gerard Taliercio
*/

DROP DATABASE IF EXISTS site_db ;
CREATE DATABASE site_db ;
USE site_db ; 

DROP TABLE IF EXISTS presidents;
CREATE TABLE IF NOT EXISTS presidents (

	id 		INT AUTO_INCREMENT PRIMARY KEY,
	fname 	TEXT NOT NULL,
	lname 	TEXT NOT NULL,
	number 	INT NOT NULL,
	dob 	DATETIME NOT NULL
);

INSERT INTO presidents (fname, lname, number, dob)
VALUES 	("George", "Washington", 1, '1731-02-11 00:00:00'),
		("James", "Madison", 4, '1751-03-16 00:00:00'),
		("John", "Adams", 2, '1735-10-30 00:00:00'),
		("Thomas", "Jefferson", 3, '1743-04-13 00:00:00'),
		("James", "Monroe", 5, '1758-04-28 00:00:00');
		

# Outputs the unsorted presidents table.
SELECT *
FROM presidents;

#Outputs the dead presidents sorted in ascending order by number.
SELECT lname, number, dob
FROM presidents
ORDER BY number ASC;

#Outputs the dead presidents sorted in ascending order by last name.
SELECT lname, number, dob
FROM presidents
ORDER BY lname ASC;

#Outputs the dead presidents sorted in descending order by DOB.
SELECT lname, number, dob
FROM presidents
ORDER BY dob DESC;
