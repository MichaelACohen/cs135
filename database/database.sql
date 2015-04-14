DROP DATABASE IF EXISTS db;

CREATE DATABASE db;

GRANT ALL PRIVILEGES ON db.* to root@localhost IDENTIFIED BY 'michael';

USE db;

#testing git
#added role just in case

CREATE TABLE Users (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	display_name text NOT NULL,
	username VARCHAR(32) NOT NULL UNIQUE,
	password VARCHAR(32) NOT NULL,
	role ENUM('user', 'administrator') NOT NULL
) ENGINE=InnoDB;

CREATE TABLE Videos (
	vid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	url VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE Hashtags (
	hid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tag VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

#This contains a row for each video/hashtag combo
#So if a video with id 1 is uploaded with 
#hashtags with ids 1 and 2,
#we will insert two rows { (1, 1), (1, 2) } in table

CREATE TABLE VideoHashtags (
	videoID INT UNSIGNED NOT NULL,
	hashtagID INT UNSIGNED NOT NULL,
	PRIMARY KEY (videoID, hashtagID),
	FOREIGN KEY (videoID)
		REFERENCES Videos(vid),
	FOREIGN KEY (hashtagID)
		REFERENCES Hashtags(hid)
) ENGINE=InnoDB;

CREATE TABLE Likes (
	userID INT UNSIGNED NOT NULL,
	videoID INT UNSIGNED NOT NULL,
	PRIMARY KEY (userID, videoID),
	FOREIGN KEY (userID)
		REFERENCES Users(id),
	FOREIGN KEY (videoID)
		REFERENCES Videos(vid)
) ENGINE=InnoDB;

#Check Robin's nest example to see if this should have primary key
CREATE TABLE Comments (
	userID INT UNSIGNED NOT NULL,
	videoID INT UNSIGNED NOT NULL,
	message TEXT,
	FOREIGN KEY (userID)
		REFERENCES Users(id),
	FOREIGN KEY (videoID)
		REFERENCES Videos(vid)
) ENGINE=InnoDB;

CREATE TABLE Follows (
	followerID INT UNSIGNED NOT NULL,
	followeeID INT UNSIGNED NOT NULL,
	PRIMARY KEY (followerID, followeeID),
	FOREIGN KEY (followerID)
		REFERENCES Users(id),
	FOREIGN KEY (followeeID)
		REFERENCES Users(id)
) ENGINE=InnoDB;
