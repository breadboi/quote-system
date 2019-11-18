-- Creation script for the sales_associates table
USE prod;
CREATE TABLE `sales_associates` (
	`id` VARCHAR(50) NOT NULL DEFAULT 'UUID()',
	`name` VARCHAR(50) NULL DEFAULT NULL,
	`password` VARCHAR(50) NULL DEFAULT NULL,
	`accumulated_commission` INT(11) NULL DEFAULT NULL,
	`address` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
;