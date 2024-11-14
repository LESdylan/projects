DELETE FROM `expenses_by_items`;
ALTER TABLE `expenses_by_items` AUTO_INCREMENT = 1;
INSERT INTO expenses_by_items (user_id, category_id, shop, qty, qty_unit, price_per_item, price_unit)
VALUES
(1, 13, 'la fuente', 1.00, 'unit', 1.00, 'unit'),
(1, 12, 'la fuente', 1.00, 'unit', 10.99, 'unit'),
(1, 4, 'la fuente', 1.00, 'unit', 2.49, 'unit'),
(1, 4, 'la fuente', 1.00, 'unit', 2.99, 'unit'),
(1, 2, 'la fuente', 1.00, 'unit', 4.99, 'unit'),
(1, 3, 'la fuente', 1020.00, 'gram', 2.99, 'kg'),
(1, 3, 'la fuente', 8.00, 'gram', 6.99, 'kg'),
(1, 3, 'la fuente', 1.00, 'unit', 3.99, 'unit'),
(1, 3, 'la fuente', 1.00, 'unit', 1.99, 'unit'),
(1, 3, 'la fuente', 34.00, 'gram', 9.99, 'kg'),
(1, 3, 'la fuente', 36.50, 'gram', 3.49, 'kg'),
(1, 3, 'la fuente', 37.50, 'gram', 2.49, 'kg'),
(1, 3, 'la fuente', 50.00, 'gram', 3.99, 'kg'),
(1, 3, 'la fuente', 1495.00, 'gram', 3.49, 'kg'),
(1, 3, 'la fuente', 14.50, 'gram', 3.99, 'kg'),
(1, 3, 'la fuente', 10.00, 'gram', 5.99, 'kg');