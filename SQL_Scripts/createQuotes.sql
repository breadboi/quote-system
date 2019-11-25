DROP TABLE IF EXISTS line_item;
DROP TABLE IF EXISTS quotes;

CREATE TABLE quotes (
    id int NOT NULL AUTO_INCREMENT,
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
    id int NOT NULL AUTO_INCREMENT,
    line_number INT NULL DEFAULT NULL,
    description varchar(500) NULL DEFAULT NULL,
    price FLOAT(16) NULL DEFAULT NULL, 
    quote_id int NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (quote_id) REFERENCES quotes (id)
);


INSERT INTO quotes (customer_name, contact, street, city, secret_notes, status, discount)
VALUES ('IBM', '847-630-244', 'Swag Lane', 'FlavorTown', 'Testing Secrete Notes', '0', '0');

SELECT @last:=LAST_INSERT_ID();

INSERT INTO line_item (line_number, description, price, quote_id)
VALUES (1, 'This is a test decription for the line', 50.23, @last);

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