SELECT * FROM genres;

-- SELECT tracks.name As track_name, genres.name as genre_name, media_types.name as media_name
-- FROM tracks
-- JOIN genres
-- 	ON genres.genre_id = tracks.genre_id
-- JOIN media_types
-- 	ON media_types.media_type_id = tracks.media_type_id
-- WHERE tracks.name LIKE '%love%'
-- AND tracks.genre_id = 1;

SELECT tracks.name AS track, genres.name AS genre, media_types.name As media
FROM tracks
JOIN genres
	ON genres.genre_id = tracks.genre_id
JOIN media_types
	ON media_types.media_type_id = tracks.media_type_id
WHERE tracks.name LIKE '%love%'
AND tracks.genre_id = 1;

SELECT tracks.name AS track, genres.name AS genre, media_types.name AS media
FROM tracks
JOIN genres
	ON genres.genre_id = tracks.genre_id
JOIN media_types
	ON media_types.media_type_id = tracks.media_type_id
WHERE 1=1;