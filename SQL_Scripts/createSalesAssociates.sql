--Creation Script for the sales_associates table

CREATE TABLE 'sales_associates' (
	'id' VARCHAR(50) NOT NULL DEFAULT 'UUID()',
	'name' VARCHAR(50) NULL DEFAULT NULL,
	'password' VARCHAR(50) NULL DEFAULT NULL,
	'accumulated_commission' VARCHAR(50) NULL DEFAULT NULL,
	'address' VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY ('id')
)
COLLATE='latin1_swedish_ci'
;