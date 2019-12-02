DROP TABLE IF EXISTS line_item;
DROP TABLE IF EXISTS quotes;

CREATE TABLE quotes (
    id int NOT NULL AUTO_INCREMENT,
    customer_name varchar(50) NULL DEFAULT NULL,
    contact varchar(50) NULL DEFAULT NULL,
    street varchar(50) NULL DEFAULT NULL,
    city varchar(50) NULL DEFAULT NULL,
    email varchar(50) NULL DEFAULT NULL,
    secret_notes varchar(500) NULL DEFAULT NULL,
    status int NULL DEFAULT NULL,
    discount FLOAT(16) NULL DEFAULT NULL,
    date_created DATE NULL DEFAULT NULL,
    sales_associate_id varchar(50) NULL DEFAULT NULL,
    FOREIGN KEY (sales_associate_id) REFERENCES sales_associates (id),
    PRIMARY KEY (id)
);

CREATE TABLE line_item (
    id int NOT NULL AUTO_INCREMENT,
    line_number INT NULL DEFAULT NULL,
    description varchar(500) NULL DEFAULT NULL,
    price FLOAT(16) NULL DEFAULT NULL, 
    quote_id int NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (quote_id) REFERENCES quotes (id)
);


INSERT INTO quotes (customer_name, contact, street, city, email, secret_notes, status, discount, sales_associate_id, date_created)
VALUES ('IBM', '847-630-244', 'Swag Lane', 'FlavorTown', 'Email@me.net' ,'Testing Secrete Notes', '0', '0', "4b570be2-09af-11ea-957f-1c872c422ccb", CURDATE());

#SELECT @last:=LAST_INSERT_ID();

INSERT INTO line_item (line_number, description, price, quote_id)
VALUES (1, 'This is a test decription for the line', 50.23, 1);

INSERT INTO quotes (customer_name, contact, street, city, email, secret_notes, status, discount, sales_associate_id, date_created)
VALUES ('APPLE', '847-610-244', 'New Hampshire', 'FlavorTown', 'Email@me.com' ,'Testing Secret Notes again', '1', '0', "3ed47645-149f-11ea-953b-1c872c422ccb", CURDATE());

/*
CREATE TABLE quotes (
    id varchar(50) NOT NULL DEFAULT uuid(),
    customer_name varchar(50) NULL DEFAULT NULL,
    contact varchar(50) NULL DEFAULT NULL,
    street varchar(50) NULL DEFAULT NULL,
    city varchar(50) NULL DEFAULT NULL,
    secret_notes varchar(500) NULL DEFAULT NULL,
    status BOOL NULL DEFAULT NULL,
    discount FLOAT(16) NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE line_item (
    id varchar(50) NOT NULL DEFAULT uuid(),
    line_number INT NULL DEFAULT NULL,
    description varchar(500) NULL DEFAULT NULL,
    price FLOAT(16) NULL DEFAULT NULL, 
    quote_id varchar(50) NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (quote_id) REFERENCES quotes (id)
);
*/