-- Drop tables and views if they exist
DROP TABLE IF EXISTS `tickets`, `bill_logs`, `bills`, `expenses_by_items`, `bank_accounts`, `categories`, `user_logs`, `users`;

-- Create the users table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(32) NOT NULL UNIQUE,
    `password` VARCHAR(64) NOT NULL,  -- Increased size for hashed passwords
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create the categories table
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(32) NOT NULL UNIQUE
);

-- Create the bank_accounts table
CREATE TABLE IF NOT EXISTS `bank_accounts` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `bank_name` VARCHAR(64) NOT NULL,
    `account_balance` DECIMAL(10,2) DEFAULT 0.00 CHECK (`account_balance` >= 0),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    UNIQUE (`user_id`, `bank_name`)  -- Ensure each user has a unique account per bank
);

-- Create the expenses_by_items table
CREATE TABLE IF NOT EXISTS `expenses_by_items` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `category_id` INT,
    `shop` ENUM('mercadona', 'la fuente') NOT NULL DEFAULT 'mercadona',
    `qty` DECIMAL(10,2) UNSIGNED NOT NULL CHECK (`qty` > 0),
    `qty_unit` ENUM('unit', 'gram', 'kg') NOT NULL,
    `price_per_item` DECIMAL(10,2) UNSIGNED NOT NULL CHECK (`price_per_item` >= 0),
    `price_unit` ENUM('unit', 'kg', 'gram') NOT NULL,   
    `prices` DECIMAL(10,2) GENERATED ALWAYS AS (
        CASE 
            WHEN qty_unit = 'gram' AND qty > 999 THEN (qty / 1000) * price_per_item
            WHEN qty_unit = 'gram' AND qty > 99 THEN (qty / 1000) * price_per_item
            WHEN qty_unit = 'gram' AND qty > 9 THEN (qty / 100) * price_per_item
            WHEN qty_unit = 'gram' AND qty > 0 THEN (qty / 100) *price_per_item
            WHEN qty_unit = 'unit' AND price_unit = 'unit' THEN qty * price_per_item
            ELSE NULL  -- Gère d'autres cas ou incohérences d'unité
        END
    ) STORED,
    `purchase_date` DATE NOT NULL DEFAULT CURRENT_DATE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
);



-- Create the tickets table
CREATE TABLE IF NOT EXISTS `tickets` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `purchase_date` DATE NOT NULL,
    `description` TEXT,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- Create the bills table
CREATE TABLE IF NOT EXISTS `bills` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `total_amount` DECIMAL(10,2) NOT NULL CHECK (`total_amount` >= 0),
    `paid_status` ENUM('unpaid', 'paid') DEFAULT 'unpaid',
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- Create the bill_logs table to track bill status changes
CREATE TABLE IF NOT EXISTS `bill_logs` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `bill_id` INT,
    `old_status` ENUM('unpaid', 'paid'),
    `new_status` ENUM('unpaid', 'paid'),
    `change_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`bill_id`) REFERENCES `bills`(`id`) ON DELETE CASCADE
);

-- Create the user_logs table to track user changes
CREATE TABLE IF NOT EXISTS `user_logs` (
    `user_id` INT PRIMARY KEY,  -- Primary and foreign key
    `old_username` VARCHAR(32),  -- Old username
    `new_username` VARCHAR(32),  -- New username
    `old_password` VARCHAR(64),  -- Old password
    `new_password` VARCHAR(64),  -- New password
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,  -- Update timestamp
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE  -- Reference to users table
);

