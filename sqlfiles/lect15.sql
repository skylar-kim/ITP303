SELECT *
FROM albums;

-- Add album 'Fight On' by artist "Spirit of Troy"
INSERT INTO albums (title, artist_id)
VALUES('Fight On', 276);

-- Search for the id for artist "Spirit of Troy"
SELECT *
FROM artists
WHERE name LIKE '%spirit%';

-- 
INSERT INTO artists (name)
VALUES('Spirit of Troy');

-- Check if album was added
SELECT *
FROM albums
ORDER BY album_id DESC;

-- Update track All My Love composed by E. Schrody and L. Dimant
-- to be a part of 'Fight On' album and composed by 'Tommy Trojan'
-- whenever using where clauses, avoid doing string search
-- use the primary keys to search for stuff. 
-- otherwise might update more than 1 thing
SELECT * FROM tracks;

UPDATE tracks
SET album_id = 348, composer = 'Tommy Trojan'
-- there are actually more than one song named 'All My Love' so the below
-- WHERE statement will affect more than one song. Instead, use a 
-- primary ley to ensure uniqueness
WHERE track_id = 3316;

SELECT * FROM tracks
WHERE name LIKE 'All My Love';

-- DELETE the album 'Fight On'
DELETE FROM albums
WHERE album_id = 348;
-- Error Code: 1451. Cannot delete or update a parent row: a foreign key constraint fails (`kimsooye_song_db`.`tracks`, CONSTRAINT `tracks_ibfk_3` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`))	0.066 sec

-- Two options to handle this error
-- 1) Delete the 'All My Love' track that references album_id = 348
-- 2) Change the album_id of 'All My Love' to be NULL

UPDATE tracks
SET album_id = null
WHERE track_id = 3316;

SELECT * 
FROM albums;

-- Create a view that displays all albums and their artist names
CREATE VIEW album_artist AS
SELECT album_id, title, name
FROM albums
JOIN artists
ON albums.artist_id = artists.artist_id;

-- After creating a view, can quickly see a view by running a select statement
SELECT * FROM album_artist;


-- Some Aggregate Functions!
-- Count of all the tracks in the DB
SELECT COUNT(*)
FROM tracks;

SELECT COUNT(*), COUNT(composer)
FROM tracks;

-- In tracks table, what's the longest track? shortest track? average?
SELECT MAX(milliseconds), MIN(milliseconds), AVG(milliseconds), SUM(milliseocnds)
FROM tracks;

-- This shows the shortest track overall
SELECT MIN(milliseconds)
FROM tracks;

-- Find shortest track for EACH album
SELECT album_id, MIN(milliseconds)
FROM tracks
GROUP BY album_id;




