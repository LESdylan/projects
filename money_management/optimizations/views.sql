DROP VIEW IF EXISTS `user_bank_details`;
DROP VIEW IF EXISTS `expenses_by_category`;
DROP VIEW IF EXISTS `user_expenses_details`;
DROP VIEW IF EXISTS `user_bills_status`;
DROP VIEW IF EXISTS `total_expenses_per_user`;
DROP VIEW IF EXISTS `tickets_overview`;
-- User bank details view
CREATE VIEW `user_bank_details` AS
SELECT 
    u.`id` AS user_id,
    u.`username`,
    b.`id` AS bank_account_id,
    b.`bank_name`,
    b.`account_balance`
FROM 
    `users` u
LEFT JOIN 
    `bank_accounts` b ON u.`id` = b.`user_id`;

-- Expenses by category view
CREATE VIEW `expenses_by_category` AS
SELECT 
    c.`id` AS category_id,
    c.`name` AS category_name,
    SUM(e.`qty`) AS total_quantity,
    SUM(e.`qty` * e.`price_per_item`) AS total_amount_spent
FROM 
    `expenses_by_items` e
JOIN 
    `categories` c ON e.`category_id` = c.`id`
GROUP BY 
    c.`id`, c.`name`;

-- User expenses details view
CREATE VIEW `user_expenses_details` AS
SELECT 
    u.`id` AS user_id,
    u.`username`,
    e.`id` AS expense_id,
    c.`name` AS category_name,
    e.`qty`,
    e.`price_per_item`,
    (e.`qty` * e.`price_per_item`) AS total_price,
    e.`purchase_date`
FROM 
    `users` u
JOIN 
    `expenses_by_items` e ON u.`id` = e.`user_id`
LEFT JOIN 
    `categories` c ON e.`category_id` = c.`id`;

-- User bills status view
CREATE VIEW `user_bills_status` AS
SELECT 
    u.`id` AS user_id,
    u.`username`,
    b.`id` AS bill_id,
    b.`total_amount`,
    b.`paid_status`,
    b.`updated_at` AS last_update
FROM 
    `users` u
JOIN 
    `bills` b ON u.`id` = b.`user_id`;

-- Tickets overview view
CREATE VIEW `tickets_overview` AS
SELECT 
    t.`id` AS ticket_id,
    u.`username` AS user,
    t.`purchase_date`,
    t.`description`
FROM 
    `tickets` t
JOIN 
    `users` u ON t.`user_id` = u.`id`;


-- create a view of expenses by user
CREATE VIEW user_expense_summary AS
SELECT 
    u.id AS user_id,
    u.name AS user_name,
    c.name AS category_name,
    SUM(e.prices) AS total_spent,
    COUNT(e.id) AS number_of_items
FROM
    users u 
JOIN expenses_by_items e ON u.id = e.user_id
JOIN categories c ON e.category_id = c.id 
GROUP BY u.id, c.id;


-- view 