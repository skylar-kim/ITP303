# Lecture 13: Database Basics, Designing Databases
Lab 7: Simple Film Database (on Blackboard)
Assignment 7: SELECT SQL Statements (sqlfiles/assignment7.sql)
Lecture Files: ?

## SQL vs NoSQL
- SQL
	- SQL databases are tabular and flat and *relational*
	- record/row/instance
	- field/column/attribute
- NoSQL
	- NoSQL databases are *not* tabular and can be *nested*. Allows for flexible structure. Also called non-relational databases

## SQL Databases
- Primary Key: a field or set of fields that uniquely identify each record in a table
- Foreign Key: a field or set of fields that uniquely identify a record in another table
	- foreign key must have same data type as Primary Key
- **Data Type**:
	- Numeric: INT, BIGINT, FLOAT, DECIMAL, etc.
	- Strings: CHAR, VARCHAR, etc.
	- Date & Time: DATE, DATETIME, TIME, YEAR, etc.
	- Boolean: BIT
- Relational Type between Tables/Entities
	- Bases for interaction among tables in **Relational Databases**:
	- One to One: one thing maps to only one other thing
		- Country to Current President: One country only has 1 current president
	- One to Many: one thing maps to multiple things
		- One football player maps to many players that are part of that football team
	- Many to Many: many things map to many thing
		- A class has many students and one student takes many classes.
![relationship types](https://github.com/skylar-kim/ITP303/blob/main/midterm2/relationshiptype.png)

- Normalization: Process of organizing tables to reduce issues/anomalies
	- basically separate out redundant / repeating data into its own table
	- Do normalize fields that can be its own "entity" and shows up in multiple rows
	- Don't normalize any field that can be infinite and would need to be updated constantly
		- ie. year, price


# Lecture 14: Intro to SQL, Retrieving Data from DB
Lab: No Lab
Assignment: No Assignment
Lecture Files: sqlfiles/lect14.sql

## Retrieving Data (Read)
- `SELECT`: specifies *columns* to retrieve from DB. Separate multiple columns with commas. * means "all columns"
- `FROM`: specifies *tables* to retrieve from DB
- `WHERE`: specifies *condition(s)* while retrieving data
- `ORDER BY`: sorts data by specified column(s).
	- `ASC`: ascending order (default)
	- `DESC`: descending order

```sql
SELECT track_id, name, genre_id, composer, unit_price
FROM tracks
WHERE unit_price > 0.99
ORDER BY name;
```
## WHERE Operators
`=`: Equal to 
`<>`: Not equal to
`>`: Greater than
`<`: Less than
`>=`: Greater or equal to
`<=`: Less than or equal to
`IS NULL`: is null(empty)
`IS NOT NULL`: is not null (not empty)
`BETWEEN a AND b`: greater than a and less than b (inclusive)
`LIKE`: search for a pattern
```sql
SELECT *
FROM artists 
WHERE name = 'Frank Sinatra';

SELECT * FROM artists
WHERE name LIKE 'Frank Sinatra';
```
- to use multiple WHERE clauses, use AND/OR

## LIKE Operator
- used to search for patterns
- often used with wildcards `%`
- ![like wildcard](https://github.com/skylar-kim/ITP303/blob/main/midterm2/likewildcard.png)

## JOIN Clause
- used to combine records from multiple tables, based on table relationships
- `JOIN`: will select the intersection of A and B
- `LEFT JOIN`: will select the intersection of A and B and ALSO A's records (may prevent null fields from not showing)
```sql
SELECT columns FROM left_table
JOIN right_table
ON left_table.foreign_key = right_table.primary_key;
```

## Column Name Conflicts
- to resolve column name conflicts, prefix them with table names
```sql
SELECT tracks.album_id, albums.album_id
FROM tracks, albums;
```

## Aliasing
- used to temporarily rename columns or tables
```sql
SELECT tracks.name AS track_name, media_types.name AS media_name
FROM tracks, media_types;
```

# Lecture 15: Data Manipulation in SQL
Lab 8: More SQL Statements
Assignment 8: PHP Form Output ( not really related )
Lecture Files: sqlfiles/lect15.sql

## Adding New Records (Create)
- `INSERT INTO`: Specifies *table* and *columns* to add data
- `VALUES`: Specifies values to add in each column. 1 to 1 correlation with listed columns.
```sql
INSERT INTO tracks (name, media_type_id, genre_id, milliseconds, unit_price)
VALUES ('Tribute to Troy', 2, 12, 62000, 99.99);
```

## Reading Records (Read)
- See above for data retrieval

## Updating Existing Records (Update)
- `UPDATE`: Specifies *table* to modify
- `SET`: Specifies *columns* and new *values*
- `WHERE`: Specifies record(s) to be updated
	- WITHOUT THE `WHERE` CLAUSE, ALL REOCRDS IN THE TABLE WILL BE UPDATED
```sql
UPDATE genres
SET name = 'Rock \'n\' Roll'
WHERE genre_id = 5;
```

## Deleting Existing Records (Delete)
- `DELETE FROM`: Species *table* where the records are.
- `WHERE`: Specifies record(s) to be deleted.
- Note: when trying to delete, there may be an error where it says like foreign key constraint. to handle this, must go back to all the tables where they primary key was referenced as a foreign key, update those fields to null, and THEN finally delete the record from the database.
```sql
DELETE FROM tracks
WHERE track_id = 1;
```

## Views
- Virtual tables created from SQL queries
	- contains rows and columns
	- can be queries like tables
- Why use views?
	- Security: Only make certain rows and columns available
	- Simplicity: no need to keep joining tables for every query

```sql
CREATE VIEW pop_songs AS
SELECT tracks.name AS track_name, composer, title
FROM tracks
JOIN genres
	ON tracks.genre_id = genres.genre_id
JOIN albums
	ON tracks.album_id = albums.album_id
WHERE genres.genre_id = 9;

```

## Editing Views
`CREATE OR REPLACE`: specifies a *view* to create or edit. creates a view if it doesn't exist, updates the view if it exists.
```sql
CREATE OR REPLACE VIEW pop_songs AS
SELECT tracks.name AS track_name, composer, title, artists.name AS artist_name
FROM tracks
JOIN genres
	ON tracks.genre_id = genres.genre_id
JOIN albums
	ON tracks.album_id = albums.album_id
WHERE genres.genre_id = 9;

```

## Deleting Views
`DROP VIEW`: Specifies a view to delete
```sql
DROP VIEW pop_songs;
```

## Aggregate Functions
`COUNT()`: Count number of rows
`MIN() / MAX()`: Find column's min/max value
`AVG()`: Calculate column's average value
`SUM()`: Sum column's total values
`RAND()`: Generate a random number between 0 and 1. Used with `ORDER BY` clause to `SELECT` records in random order.
`CHAR_LENGTH()`: return length of given string
`CONCAT()`: concat strings

```sql
SELECT COUNT(*)
FROM albums
WHERE artist_id = 8;

SELECT MIN(milliseconds), MAX(milliseconds)
FROM tracks;

SELECT AVG(milliseconds)
FROM tracks
WHERE album_id = 3;

SELECT SUM(milliseconds)
FROM tracks
WHERE genre_id = 3;

SELECT * FROM tracks
ORDER BY RAND();

SELECT name, CHAR_LENGTH(name) AS name_length
FROM tracks;

SELECT CONCAT(name, ' was composed by ', composer)
FROM tracks;
```

## GROUP BY Clause
- Group results by data in specified column.
- Often used with aggregate functions

```sql
-- Show artists and number of albums for each artist
SELECT album_id, name, COUNT(*)
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id
GROUP BY artists.artist_id;

-- Find shortest track for each album
SELECT album_id, MIN(milliseconds)
FROM tracks
GROUP BY album_id;
```

# Lecture 16: Intro to PHP
Lab: no lab
Assignment 8: PHP Form Output
Lecture Files: lect16-intro-php

## PHP Syntax
- all php code goes in between `<?php ?>` opening and closing bracket
- end with semicolon
- variables:
	- start with dollar sign ($)
	- start with letter or underscore
	- case sensitive
- printing out in php:
	`echo` keyword

## Superglobals
- built-in super global variables
- `$_SERVER`: Array with server and environment information
- `$_GET`: Array of HTTP GET variables
- `$_POST`: Array of HTTP POST variables

## HTTP POST Method
- Submits all form data in HTTP header
- use `$_POST` associative array to access data
- IMPORTANT: array key corresponds to `name` attribute value of the form element

## HTTP GET Method
- submits all form data through the URL
- `http://example.com?key1=val1&key2=val2`
- Use `$_GET` associative array to access data
- IMPORTANT: array key corresponds to `name` attribute value of the form element
	- so, if the form doesn't have `name` attribute anywhere, we get no data

## POST vs GET
- POST: parameters send via headers
	- use POST method when:
		- security is important
		- sending large amounts of data
		- usually used to insert/update data
- GET: parameters are sent in the URL - visible to all users
	- use GET method when:
		- handling non-sensitive data
		- sending small amount of data
		- users can bookmark data
		- usually used to retrieve data





































