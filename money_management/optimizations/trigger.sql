-- Drop triggers if they exist
DROP TRIGGER IF EXISTS `log_user_change`;
DROP TRIGGER IF EXISTS `log_bill_status_change`;
DROP TRIGGER IF EXISTS `default_expense_category`;
DROP TRIGGER IF EXISTS `prevent_overdraft`;
DROP TRIGGER IF EXISTS `update_user_timestamp`;

DELIMITER //

CREATE TRIGGER `log_user_change`
AFTER UPDATE ON `users`
FOR EACH ROW
BEGIN
    -- Only log if there's a change in username or password
    IF OLD.`username` <> NEW.`username` OR OLD.`password` <> NEW.`password` THEN
        -- Check if a log already exists for this user
        IF EXISTS (SELECT 1 FROM `user_logs` WHERE `user_id` = OLD.`id`) THEN
            -- If log exists, update it
            UPDATE `user_logs`
            SET `old_username` = OLD.`username`, 
                `new_username` = NEW.`username`, 
                `old_password` = OLD.`password`, 
                `new_password` = NEW.`password`, 
                `updated_at` = CURRENT_TIMESTAMP
            WHERE `user_id` = OLD.`id`;
        ELSE
            -- If no log exists, insert a new log entry
            INSERT INTO `user_logs` (`user_id`, `old_username`, `new_username`, `old_password`, `new_password`, `updated_at`)
            VALUES (OLD.`id`, OLD.`username`, NEW.`username`, OLD.`password`, NEW.`password`, CURRENT_TIMESTAMP);
        END IF;
    END IF;
END;
//

DELIMITER ;
DELIMITER //

CREATE TRIGGER `log_new_user_insert`
AFTER INSERT ON `users`
FOR EACH ROW
BEGIN
    -- Insert a log entry for the new user
    INSERT INTO `user_logs` (`user_id`, `old_username`, `new_username`, `old_password`, `new_password`, `updated_at`)
    VALUES (NEW.`id`, NULL, NEW.`username`, NULL, NEW.`password`, CURRENT_TIMESTAMP);
END;
//
DELIMITER ;



-- Create triggers after table creation
DELIMITER //
CREATE TRIGGER `update_user_timestamp`
BEFORE UPDATE ON `users`
FOR EACH ROW
BEGIN
    SET NEW.`updated_at` = CURRENT_TIMESTAMP;
END;
//
DELIMITER ;
