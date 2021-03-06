SELECT * FROM genres;

SELECT * FROM ratings;

SELECT * FROM labels;

SELECT * FROM formats;

SELECT * FROM sounds;

SELECT * FROM dvd_titles;

SELECT * FROM dvd_titles
JOIN genres
	ON genres.genre_id = dvd_titles.genre_id
JOIN ratings
	ON ratings.rating_id = dvd_titles.rating_id
JOIN labels
	ON labels.label_id = dvd_titles.label_id
JOIN formats
	ON formats.format_id = dvd_titles.format_id
JOIN sounds
	ON sounds.sound_id = dvd_titles.sound_id
WHERE 1=1
-- AND dvd_titles.release_date between '1999-01-01' and '1999-12-31'
-- AND dvd_titles.release_date > '1999-01-01'
AND dvd_titles.release_date < '1999-12-31'
ORDER BY dvd_titles.dvd_title_id;


SELECT dvd_titles.title as title, dvd_titles.release_date as release_date, 
genres.genre as genre, labels.label as label, ratings.rating as rating,
sounds.sound as sound, formats.format as format, dvd_titles.award as award
FROM dvd_titles
JOIN genres
	ON genres.genre_id = dvd_titles.genre_id
JOIN ratings
	ON ratings.rating_id = dvd_titles.rating_id
JOIN labels
	ON labels.label_id = dvd_titles.label_id
JOIN formats
	ON formats.format_id = dvd_titles.format_id
JOIN sounds
	ON sounds.sound_id = dvd_titles.sound_id
WHERE 1=1
AND dvd_title_id = 114;

SELECT * FROM dvd_titles;
    