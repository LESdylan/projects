-- insert categories
INSERT INTO `categories` (`name`) VALUES 
('Fruits'),
('Vegetables'),
('Organic Products'),
('Grocery'),
('Beverages'),
('Dairy Products'),
('Meat'),
('Fish'),
('Condiments'),
('Cereals and Grains'),
('Bakery Goods'),
('Honey Products'),
('Herbs and Spices'),
('Snacks and Sweets'),
('Hygiene and Cleaning'),
('Frozen Foods'),
('Bakery Items'),
('Oils and Sauces'),
('Canned Goods');


INSERT INTO `users`(`username`, `password`) VALUES
('dylandev','nothing'),
('susana', 'nothing');

UPDATE `users` 
SET `password`= 'sfdfsdf', `username` = 'dyl'
WHERE `username` = 'dylandev';

UPDATE `users` 
SET `password`= 'jfsdfsdf', `username` = 'sushigueras'
WHERE `username` = 'susana';