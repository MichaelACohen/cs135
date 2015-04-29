#users
INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Michael", "michael", "1103c2be9d0858276e150bcd4ee477a7", "user"
);

INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Sallie", "sallie", "208d48c84294fb3153b2057d7f9728f1", "user"
);

INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Kenton", "kenton", "861519ea36b8a80457d7e685b14d66da", "user"
);

INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Connor", "connor", "37180c909687e65862382e078f95c02e", "user"
);

#videos
INSERT INTO Videos (youtubeID) VALUES ("3aF-ANf4KY8");
INSERT INTO Videos (youtubeID) VALUES ("B38wu7wxGjg");
INSERT INTO Videos (youtubeID) VALUES ("fWNaR-rxAic");
INSERT INTO Videos (youtubeID) VALUES ("0pajUiPYjrI");
INSERT INTO Videos (youtubeID) VALUES ("qnHyhCYOgTI");
INSERT INTO Videos (youtubeID) VALUES ("9NLZCLKppZs");
INSERT INTO Videos (youtubeID) VALUES ("g6ducUsfllU");
INSERT INTO Videos (youtubeID) VALUES ("Xm49yEL6ca4");
INSERT INTO Videos (youtubeID) VALUES ("wUfVeUu0fuY");
INSERT INTO Videos (youtubeID) VALUES ("cSWqxbswQAY");
INSERT INTO Videos (youtubeID) VALUES ("iD2rhdFRehU");
INSERT INTO Videos (youtubeID) VALUES ("AKZWI7V8h-g");
INSERT INTO Videos (youtubeID) VALUES ("xEYV5bNMZVo");
INSERT INTO Videos (youtubeID) VALUES ("_oEKgfawEJQ");
INSERT INTO Videos (youtubeID) VALUES ("tdmyoMe4iHM");
INSERT INTO Videos (youtubeID) VALUES ("gZNraqVnlu0");
INSERT INTO Videos (youtubeID) VALUES ("8jEt0OfRDVI");
INSERT INTO Videos (youtubeID) VALUES ("oVUtSDKy3TM");
INSERT INTO Videos (youtubeID) VALUES ("FCWLtyTmX3o");
INSERT INTO Videos (youtubeID) VALUES ("C3Ue1AXSzyw");


#videofeed
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 1);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 5);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 2);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 3);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 4);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 3);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 4);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 3);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 8);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 7);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 8);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 9);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 11);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 12);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 13);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 14);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 10);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 9);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 15);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 16);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 17);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 18);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 11);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 13);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 20);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 16);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 16);



#hashtags
INSERT INTO Hashtags (tag) VALUES ("pomona");
INSERT INTO Hashtags (tag) VALUES ("ppwwp");
INSERT INTO Hashtags (tag) VALUES ("music");
INSERT INTO Hashtags (tag) VALUES ("cats");
INSERT INTO Hashtags (tag) VALUES ("kobe");

#video hashtags
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (1, 1);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (2, 2);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (3, 3);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (4, 4);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (5, 5);

#likes
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (2, 1, 1);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 1, 1);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 2, 2);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (3, 2, 2);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (4, 2, 2);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 3, 3);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (4, 3, 3);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (2, 4, 4);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (4, 4, 4);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (3, 1, 5);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 1, 5);

#comments
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (3, 1, 1, "this school sucks");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (1, 1, 1, "lol");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (4, 2, 2, "nice");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (2, 2, 2, "thanks");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (1, 3, 3, "cute");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (4, 4, 4, "cats");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (3, 1, 5, "yes michael");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (3, 1, 5, "Kobe.");

#follows
INSERT INTO Follows (followerID, followeeID) VALUES (1, 2);
INSERT INTO Follows (followerID, followeeID) VALUES (1, 3);
INSERT INTO Follows (followerID, followeeID) VALUES (1, 4);
INSERT INTO Follows (followerID, followeeID) VALUES (2, 1);
INSERT INTO Follows (followerID, followeeID) VALUES (2, 4);
INSERT INTO Follows (followerID, followeeID) VALUES (3, 1);
INSERT INTO Follows (followerID, followeeID) VALUES (4, 1);
INSERT INTO Follows (followerID, followeeID) VALUES (4, 2);