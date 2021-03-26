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


