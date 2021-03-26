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
AND dvd_titles.award IS NULL
ORDER BY dvd_titles.dvd_title_id;
    