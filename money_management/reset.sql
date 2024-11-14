-- delete table and reset AUTO_increment constraint to it's base value.
DELETE FROM categories;
ALTER TABLE categories AUTO_INCREMENT = 1;