-- Display albums that have the letters "on" in the album title
-- sort results in alphabetical order by album title
SELECT *
FROM albums
WHERE title like '%on%'
ORDER BY title;

-- only show album title and artist name (no artist_id)
SELECT albums.title as title, artists.name as name
FROM albums
JOIN artists
ON albums.artist_id = artists.artist_id
WHERE title like '%on%'
ORDER BY title;

-- SELECT * 
-- FROM media_types;

-- Display tracks that have AAC audio file format.
-- Only show track name (alias: track_name), composer, 
-- media type name (alias: media_type), and unit price columns.
SELECT 
tracks.name as track_name, tracks.composer as composer, 
media_types.name as media_type, tracks.unit_price as unit_price
FROM tracks
JOIN media_types
ON tracks.media_type_id = media_types.media_type_id
WHERE media_types.media_type_id = 5;

-- SELECT * 
-- FROM genres;
-- Display R&B/soul and jazz tracks that have a composer (Not null)
-- sort results in reverse alphabetical order by track name
-- only show track ID, track name (track_name), composer, milliseconds, and genre name (genre_name)
SELECT tracks.track_id, tracks.name as track_name, 
tracks.composer, tracks.milliseconds, genres.name as genre_name
FROM tracks
JOIN genres
ON tracks.genre_id = genres.genre_id
WHERE (tracks.genre_id = 2 OR tracks.genre_id = 14) AND tracks.composer IS NOT NULL
ORDER BY tracks.name DESC;



-- DVD STATEMENTS

-- SELECT * 
-- FROM genres;
-- Display drama genre DVDs that won awards. 
-- Sort results by year of when the DVD won an award. Show dvd title, award, genre
-- label, and rating
SELECT dvd_titles.title as title, dvd_titles.award as award, genres.genre as genre,
labels.label as label, ratings.rating as rating
FROM dvd_titles
JOIN genres
ON dvd_titles.genre_id = genres.genre_id
JOIN ratings
ON dvd_titles.rating_id = ratings.rating_id
JOIN labels
ON dvd_titles.label_id = labels.label_id
WHERE award IS NOT NULL AND dvd_titles.genre_id = 9
ORDER by dvd_titles.award;

-- Display DVDs made by Universal (a label) and have DTS sound. Show dvd title, sound, label
-- genre, and rating
-- SELECT * 
-- FROM sounds;
-- sound_id = 4 is DTS sound
-- SELECT * 
-- FROM labels;
SELECT dvd_titles.title as title, sounds.sound as sound, labels.label as label, 
genres.genre as genre, ratings.rating as rating
FROM dvd_titles
JOIN sounds
ON dvd_titles.sound_id = sounds.sound_id
JOIN labels
ON dvd_titles.label_id = labels.label_id
JOIN genres
ON dvd_titles.genre_id = genres.genre_id
JOIN ratings
ON dvd_titles.rating_id = ratings.rating_id
WHERE dvd_titles.sound_id = 4 AND dvd_titles.label_id = 127;

-- Display R-rated Sci-Fi DVDs that have a release date (not NULL)
-- Order results from newest to oldest released DVD. 
-- Show dvd title, release date, rating, genre, sound, and label
-- SELECT *
-- FROM sounds;

SELECT dvd_titles.title as title, dvd_titles.release_date, 
ratings.rating as rating, genres.genre as genre, 
sounds.sound as sound, labels.label as label
FROM dvd_titles
JOIN ratings
ON dvd_titles.rating_id = ratings.rating_id
JOIN genres
ON dvd_titles.genre_id = genres.genre_id
JOIN sounds
ON dvd_titles.sound_id = sounds.sound_id
JOIN labels
ON dvd_titles.label_id = labels.label_id
WHERE dvd_titles.release_date IS NOT NULL AND
dvd_titles.rating_id = 7 AND
genres.genre_id = 19
ORDER BY dvd_titles.release_date DESC;







