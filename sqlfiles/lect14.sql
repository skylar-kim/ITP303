-- Select all the columns from the tracks table
-- * references to columns
SELECT * 
FROM tracks;

SELECT * 
FROM artists;

-- SELECT selects COLUMNS 
SELECT name, composer, unit_price
FROM tracks;

-- Display tracks that cost more than 0.99 
-- Sort them from shortest to longest (in length)
-- default sort: ascending
-- Only show track id, name, price, and length
SELECT track_id, name, unit_price, milliseconds
FROM tracks
WHERE unit_price > 0.99
ORDER BY milliseconds;

-- same as above but descending sort
SELECT *
FROM tracks
WHERE unit_price > 0.99
ORDER BY milliseconds DESC;

-- Display tracks that have a composer
-- only show the track's id, name, composer and price
SELECT track_id, name, composer, unit_price
FROM tracks
WHERE composer IS NOT NULL;

-- Display tracks that have 'you' or 'day' in the titles
SELECT *
FROM tracks
WHERE name LIKE '%you%' OR name LIKE '%day%';

-- Display tracks composed by U2 that have 'you' or 'day
-- in their titles
SELECT * 
FROM tracks
WHERE (name LIKE '%you%' OR name LIKE '%day')
AND composer LIKE '%U2%';

-- Display all albums and artists corresponding to each album
-- Only show album title and artists name
SELECT title AS album_title, name as artist_name 
FROM albums
JOIN artists
ON albums.artist_id = artists.artist_id;

-- Display all Jazz tracks
-- show track name, genre name, album title, artist name
SELECT tracks.name AS track_name, genres.name AS genre_name, albums.title AS album_name, artists.name AS artist_name
FROM tracks
JOIN genres
ON tracks.genre_id = genres.genre_id
JOIN albums
ON tracks.album_id = albums.album_id
JOIN artists
ON albums.artist_id = artists.artist_id
WHERE tracks.genre_id = 2;











