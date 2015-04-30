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

INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Karin", "karin", "fb4edbb5359e697ac511b7feab4bf1ab", "user"
);

INSERT INTO Users (
	display_name, username, password, role
) VALUES (
	"Delangis", "delangis", "e0df7f1105ee6448c9e0f297b67b30bf", "user"
);

#videos
INSERT INTO Videos (youtubeID) VALUES ("3aF-ANf4KY8");#pomona
INSERT INTO Videos (youtubeID) VALUES ("0pajUiPYjrI");#catvines
INSERT INTO Videos (youtubeID) VALUES ("qnHyhCYOgTI");#kobe
INSERT INTO Videos (youtubeID) VALUES ("9NLZCLKppZs");#john mayer
INSERT INTO Videos (youtubeID) VALUES ("g6ducUsfllU");#seals
INSERT INTO Videos (youtubeID) VALUES ("Xm49yEL6ca4");#drone surf
INSERT INTO Videos (youtubeID) VALUES ("wUfVeUu0fuY");#jack johnson
INSERT INTO Videos (youtubeID) VALUES ("cSWqxbswQAY");#hozier
INSERT INTO Videos (youtubeID) VALUES ("iD2rhdFRehU");#ed sheeran
INSERT INTO Videos (youtubeID) VALUES ("AKZWI7V8h-g");#surf dog
INSERT INTO Videos (youtubeID) VALUES ("_oEKgfawEJQ");#LOST
INSERT INTO Videos (youtubeID) VALUES ("tdmyoMe4iHM");#miracle
INSERT INTO Videos (youtubeID) VALUES ("gZNraqVnlu0");#coming to pomona
INSERT INTO Videos (youtubeID) VALUES ("8jEt0OfRDVI");#wopo
INSERT INTO Videos (youtubeID) VALUES ("oVUtSDKy3TM");#catch it
INSERT INTO Videos (youtubeID) VALUES ("FCWLtyTmX3o");#rock climbing



#videofeed 
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 1);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 2);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 3);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 4);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 5);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 6);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 7);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 8);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 9);
INSERT INTO VideoFeed (userID, videoID) VALUES (2, 10);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 11);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 12);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 3);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 13);
INSERT INTO VideoFeed (userID, videoID) VALUES (1, 14);
INSERT INTO VideoFeed (userID, videoID) VALUES (5, 15);
INSERT INTO VideoFeed (userID, videoID) VALUES (5, 16);
INSERT INTO VideoFeed (userID, videoID) VALUES (6, 16);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 3);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 7);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 2);
INSERT INTO VideoFeed (userID, videoID) VALUES (4, 5);
INSERT INTO VideoFeed (userID, videoID) VALUES (3, 6);



#hashtags
INSERT INTO Hashtags (tag) VALUES ("pomona");
INSERT INTO Hashtags (tag) VALUES ("music");
INSERT INTO Hashtags (tag) VALUES ("cats");
INSERT INTO Hashtags (tag) VALUES ("sports");
INSERT INTO Hashtags (tag) VALUES ("ocean");

#video hashtags
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (1, 1);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (13, 1);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (5, 5);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (6, 5);
INSERT INTO VideoHashtags (videoID, hashtagID) VALUES (10, 5);

#likes
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 1, 1);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (3, 2, 2);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 3, 3);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (3, 4, 4);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (4, 1, 5);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 2, 6);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (4, 2, 6);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (5, 2, 6);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (4, 3, 7);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (2, 4, 8);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (4, 5, 15);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (3, 5, 15);
INSERT INTO Likes (liker, videoOwner, videoID) VALUES (1, 4, 5);

#comments
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (5, 2, 6, "Hopefully the drone doesn't fall into the ocean.");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (2, 2, 6, "Watch out for sharks!");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (4, 2, 6, "Amazing!");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (3, 1, 14, "Whoah this is pretty cool");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (1, 1, 14, "water polo is awesome!");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (4, 5, 15, "nice");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (2, 6, 16, "thanks");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (1, 3, 3, "cute");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (4, 4, 7, "cats");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (3, 3, 2, "awesome");
INSERT INTO Comments (commenter, videoOwner, videoID, message)
VALUES (3, 4, 5, "I like this video.");

#follows
INSERT INTO Follows (followerID, followeeID) VALUES (1, 2);
INSERT INTO Follows (followerID, followeeID) VALUES (1, 3);
INSERT INTO Follows (followerID, followeeID) VALUES (1, 4);
INSERT INTO Follows (followerID, followeeID) VALUES (2, 1);
INSERT INTO Follows (followerID, followeeID) VALUES (2, 4);
INSERT INTO Follows (followerID, followeeID) VALUES (3, 1);
INSERT INTO Follows (followerID, followeeID) VALUES (4, 1);
INSERT INTO Follows (followerID, followeeID) VALUES (4, 2);