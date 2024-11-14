LOAD DATA INFILE 'E:\\script_db\\project\\assets\\la fuente\\csv\\11_13.csv'
INTO TABLE expenses_by_items
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(user_id, category_id, shop, qty, qty_unit, price_per_item, price_unit);
d