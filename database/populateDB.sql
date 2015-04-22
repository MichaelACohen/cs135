#users
INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Michael", "michael", "michael", "user"	
);

INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Sallie", "sallie", "sallie", "user"	
);

INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Kenton", "kenton", "kenton", "user"	
);

INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Connor", "connor", "connor", "user"	
);

#videos
INSERT INTO Videos (youtubeID) VALUES ("3aF-ANf4KY8");
INSERT INTO Videos (youtubeID) VALUES ("B38wu7wxGjg");
INSERT INTO Videos (youtubeID) VALUES ("fWNaR-rxAic");
INSERT INTO Videos (youtubeID) VALUES ("0pajUiPYjrI");
INSERT INTO Videos (youtubeID) VALUES ("qnHyhCYOgTI")

#videofeed
INSERT INTO VideoFeed (userID, videoID) VALUES (0, 0);
INSERT INTO VideoFeed (userID, videoID) VALUES (0, 4);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 1);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 2);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 3);

#hashtags
INSERT INTO Hashtags (tag) VALUES ("pomona");
INSERT INTO Hashtags (tag) VALUES ("ppwwp");
INSERT INTO Hashtags (tag) VALUES ("music");
INSERT INTO Hashtags (tag) VALUES ("cats");
INSERT INTO Hashtags (tag) VALUES ("kobe");

#video hashtags
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (0, 0);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (1, 1);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (2, 2);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (3, 3);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (4, 4);

#likes
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 0, 0);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (0, 0, 0);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (0, 1, 1);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (2, 1, 1);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (3, 1, 1);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (0, 2, 2);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (3, 2, 2);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 3, 3);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (3, 3, 3);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (2, 4, 4);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (0, 4, 4);

#comments
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (2, 0, 0, "this school sucks");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (0, 0, 0, "lol");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (3, 1, 1, "nice");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (1, 1, 1, "thanks");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (0, 2, 2, "cute");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (3, 3, 3, "cats");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (2, 0, 4, "yes michael");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (2, 0, 4, "Kobe.");

#follows
INSERT INTO Follows (followerID, followeeID) VALUES (0, 1);
INSERT INTO Follows (followerID, followeeID) VALUES (0, 2);
INSERT INTO Follows (followerID, followeeID) VALUES (0, 3);
INSERT INTO Follows (followerID, followeeID) VALUES (1, 0);
INSERT INTO Follows (followerID, followeeID) VALUES (1, 3);
INSERT INTO Follows (followerID, followeeID) VALUES (2, 0);
INSERT INTO Follows (followerID, followeeID) VALUES (3, 0);
INSERT INTO Follows (followerID, followeeID) VALUES (3, 1);