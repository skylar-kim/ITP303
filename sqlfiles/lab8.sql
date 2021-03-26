
-- Creating the mpeg_tracks view
CREATE VIEW mpeg_tracks AS
SELECT tracks.name as track_name, artists.name as artist_name, tracks.composer as composer,
albums.title as album_title, media_types.name as media_types
FROM tracks
JOIN albums
ON tracks.album_id = albums.album_id
JOIN artists
ON artists.artist_id = albums.artist_id
JOIN media_types
ON tracks.media_type_id = media_types.media_type_id
WHERE tracks.media_type_id = 1
ORDER BY tracks.name;

SELECT * FROM mpeg_tracks;


SELECT * FROM tracks;

SELECT * FROM artists
ORDER BY artist_id DESC;

-- led zeppelin @ 277
INSERT INTO artists (name)
VALUES ('Led Zeppelin');

SELECT *
FROM albums
ORDER BY album_id DESC;

-- album id: 349
INSERT INTO albums (title, artist_id)
VALUES ('The Song Remains The Same (Disc 1)', 277);

-- MPEG audio file : 1
SELECT * FROM media_types;

-- Rock: 1
SELECT * FROM genres;

-- adding track into database
INSERT INTO tracks (name, album_id, media_type_id, genre_id, composer, milliseconds, bytes, unit_price)
VALUES('The Ocean', 349, 1, 1, 'John Bonham/John Paul Jones/Robert Plant', 248000, 7990000, 0.99);

-- updating track
UPDATE tracks
SET bytes = 8998765, unit_price = 1.99
WHERE track_id = 3504;

-- Deleting track 20 Flight Rock
SELECT * FROM tracks
WHERE name LIKE "20 Flight Rock";

SELECT * FROM playlist_track;

SELECT * FROM playlist_track
WHERE track_id = 122;

UPDATE playlist_track
SET track_id = null
WHERE playlist_id = 1;

DELETE FROM playlist_track
WHERE track_id = 122;

DELETE FROM tracks
WHERE track_id = 122;

-- display how many tracks there are for each album
-- show album id, album title, and track count
SELECT tracks.album_id, albums.title as album_title, COUNT(tracks.album_id)
FROM tracks
JOIN albums
ON tracks.album_id = albums.album_id
GROUP BY album_id;







