-- Remove one record: Chris Pratt’s 'Americano' order purchased with Mobile.
DELETE FROM orders
WHERE id = 7;

-- Display all orders in order of newest order to latest order. 
-- Display in this order: date, name of customer, 
-- name of item ordered, payment, and source.

SELECT orders.date, orders.full_name as full_name, menu_items.name as name, 
payments.payment as payment, orders.source as source
FROM orders
JOIN payments
	ON payments.id = orders.payment_id
JOIN menu_items
	ON menu_items.id = orders.menu_id
ORDER BY orders.date ASC;

-- -- Change one record, the order made by Chris Evans on 11/08/2019 so that it has the below information.
--    a. Menu item: Peppermint Mocha
--    b. Payment: Cash
--    c. Source: Doordash
UPDATE orders
SET orders.menu_id = 5, orders.payment_id = 1, orders.source = 'Doordash'
WHERE id = 9;

-- Display number of menu items per category. 
-- Display category name (aliased as category) 
-- and number of menu items (aliased as count). 
SELECT categories.name, menu_items.category_id, COUNT(*)
FROM categories
JOIN menu_items
	ON categories.id = menu_items.category_id
GROUP BY menu_items.category_id;

-- Create a view named featured_items that would display menu items that are featured. 
-- Display the menu item’s id, name, category name (aliased as category), and price.

CREATE VIEW featured_items AS
SELECT menu_items.id, menu_items.name, categories.name AS category, menu_items.price
FROM menu_items
JOIN categories
	ON menu_items.category_id = categories.id;



