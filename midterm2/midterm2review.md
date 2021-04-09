# Lecture 13: Database Basics, Designing Databases

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

## Retrieving Data
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

## LIKE Operator
- used to search for patterns
- often used with wildcards `%`




































