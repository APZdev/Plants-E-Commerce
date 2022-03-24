
DROP DATABASE IF EXISTS tropicalinterior;
CREATE DATABASE IF NOT EXISTS tropicalinterior;
USE tropicalinterior;
/* ctrl + f : MEDIUMINT AUTO_INCREMENT for MEDIUMINT AUTO_INCREMENT */


CREATE TABLE customer(
   customer_id INT AUTO_INCREMENT,
   firstname VARCHAR(50)  NOT NULL,
   lastname VARCHAR(50)  NOT NULL,
   email VARCHAR(255)  NOT NULL,
   password VARCHAR(64)  NOT NULL,
   vkey VARCHAR(32)  NOT NULL,
   verified TINYINT NOT NULL,
   registration_date DATETIME NOT NULL,
   update_date DATETIME NOT NULL,
   PRIMARY KEY(customer_id)
);

CREATE TABLE delivery_address(
   customer_address_id INT AUTO_INCREMENT,
   firstname VARCHAR(50) ,
   lastname VARCHAR(50) ,
   city VARCHAR(50) ,
   street VARCHAR(255) ,
   zip_code VARCHAR(15) ,
   more_info VARCHAR(255) ,
   phone_number VARCHAR(25) ,
   customer_id INT NOT NULL,
   PRIMARY KEY(customer_address_id),
   UNIQUE(customer_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE category(
   category_id INT AUTO_INCREMENT,
   name VARCHAR(50)  NOT NULL,
   description VARCHAR(50)  NOT NULL,
   PRIMARY KEY(category_id)
);

CREATE TABLE image(
   image_id INT AUTO_INCREMENT,
   url VARCHAR(255)  NOT NULL,
   PRIMARY KEY(image_id)
);

CREATE TABLE user_comment(
   user_comment_id INT AUTO_INCREMENT,
   title VARCHAR(100)  NOT NULL,
   content VARCHAR(250)  NOT NULL,
   created_at DATETIME NOT NULL,
   customer_id INT NOT NULL,
   PRIMARY KEY(user_comment_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE tax(
   tax_id INT AUTO_INCREMENT,
   rate DECIMAL(15,2)   NOT NULL,
   PRIMARY KEY(tax_id)
);

CREATE TABLE admin_user(
   admin_user_id INT AUTO_INCREMENT,
   email VARCHAR(255)  NOT NULL,
   password VARCHAR(100)  NOT NULL,
   PRIMARY KEY(admin_user_id)
);

CREATE TABLE event(
   event_id INT AUTO_INCREMENT,
   type VARCHAR(50)  NOT NULL,
   start_time DATETIME NOT NULL,
   end_time DATETIME NOT NULL,
   title VARCHAR(50)  NOT NULL,
   description VARCHAR(50)  NOT NULL,
   address VARCHAR(100)  NOT NULL,
   admin_user_id INT NOT NULL,
   image_id INT NOT NULL,
   PRIMARY KEY(event_id),
   FOREIGN KEY(admin_user_id) REFERENCES admin_user(admin_user_id),
   FOREIGN KEY(image_id) REFERENCES image(image_id)
);

CREATE TABLE thread(
   thread_id INT AUTO_INCREMENT,
   title VARCHAR(50)  NOT NULL,
   type VARCHAR(100)  NOT NULL,
   customer_id INT NOT NULL,
   PRIMARY KEY(thread_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE rating(
   rating_id INT AUTO_INCREMENT,
   score INT NOT NULL,
   user_comment_id INT NOT NULL,
   PRIMARY KEY(rating_id),
   FOREIGN KEY(user_comment_id) REFERENCES user_comment(user_comment_id)
);

CREATE TABLE activity_log(
   visit_log_id INT AUTO_INCREMENT,
   action VARCHAR(50)  NOT NULL,
   created_at DATETIME NOT NULL,
   customer_id INT NOT NULL,
   PRIMARY KEY(visit_log_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE facturation_address(
   facturation_address_id INT AUTO_INCREMENT,
   firstname VARCHAR(50) ,
   lastname VARCHAR(50) ,
   city VARCHAR(50) ,
   street VARCHAR(255) ,
   zip_code VARCHAR(15) ,
   email VARCHAR(255) ,
   more_info VARCHAR(255) ,
   phone_number VARCHAR(25) ,
   PRIMARY KEY(facturation_address_id)
);

CREATE TABLE product(
   product_id INT AUTO_INCREMENT,
   name VARCHAR(50)  NOT NULL,
   short_description VARCHAR(150)  NOT NULL,
   long_description VARCHAR(500)  NOT NULL,
   price_excl_tax DECIMAL(15,2)   NOT NULL,
   stock_quantity INT NOT NULL,
   tax_id INT NOT NULL,
   image_id INT NOT NULL,
   category_id INT NOT NULL,
   PRIMARY KEY(product_id),
   FOREIGN KEY(tax_id) REFERENCES tax(tax_id),
   FOREIGN KEY(image_id) REFERENCES image(image_id),
   FOREIGN KEY(category_id) REFERENCES category(category_id)
);

CREATE TABLE command(
   command_id INT AUTO_INCREMENT,
   card_last_digits SMALLINT NOT NULL,
   card_type TINYINT NOT NULL,
   created_at DATETIME NOT NULL,
   complete BOOLEAN,
   facturation_address_id INT NOT NULL,
   PRIMARY KEY(command_id),
   FOREIGN KEY(facturation_address_id) REFERENCES facturation_address(facturation_address_id)
);

CREATE TABLE product_order(
   product_order_id INT AUTO_INCREMENT,
   quantity INT NOT NULL,
   command_id INT NOT NULL,
   product_id INT NOT NULL,
   PRIMARY KEY(product_order_id),
   FOREIGN KEY(command_id) REFERENCES command(command_id),
   FOREIGN KEY(product_id) REFERENCES product(product_id)
);

CREATE TABLE delivery(
   delivery_id INT AUTO_INCREMENT,
   status VARCHAR(50)  NOT NULL,
   tracking_number VARCHAR(13) ,
   delivery_line_link VARCHAR(2083) ,
   command_id INT NOT NULL,
   customer_address_id INT NOT NULL,
   PRIMARY KEY(delivery_id),
   FOREIGN KEY(command_id) REFERENCES command(command_id),
   FOREIGN KEY(customer_address_id) REFERENCES delivery_address(customer_address_id)
);

CREATE TABLE shipping_cost(
   shipping_cost_id INT AUTO_INCREMENT,
   price DECIMAL(6,2)   NOT NULL,
   product_order_id INT NOT NULL,
   PRIMARY KEY(shipping_cost_id),
   UNIQUE(product_order_id),
   FOREIGN KEY(product_order_id) REFERENCES product_order(product_order_id)
);

CREATE TABLE reserve(
   customer_id INT,
   command_id INT,
   PRIMARY KEY(customer_id, command_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id),
   FOREIGN KEY(command_id) REFERENCES command(command_id)
);

CREATE TABLE judge(
   product_id INT,
   user_comment_id INT,
   PRIMARY KEY(product_id, user_comment_id),
   FOREIGN KEY(product_id) REFERENCES product(product_id),
   FOREIGN KEY(user_comment_id) REFERENCES user_comment(user_comment_id)
);

CREATE TABLE subscribe(
   customer_id INT,
   event_id INT,
   PRIMARY KEY(customer_id, event_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id),
   FOREIGN KEY(event_id) REFERENCES event(event_id)
);

CREATE TABLE populate(
   user_comment_id INT,
   thread_id INT,
   PRIMARY KEY(user_comment_id, thread_id),
   FOREIGN KEY(user_comment_id) REFERENCES user_comment(user_comment_id),
   FOREIGN KEY(thread_id) REFERENCES thread(thread_id)
);




/* ---------------------- FILL DATABASE WITH EXAMPLE DATA ---------------------- */

/* SETUP EXAMPLE ADMIN ACCOUNTS */
INSERT INTO admin_user (email, password) VALUES ('admin1@localhost.fr', 'admin123');
SET @admin_user_id = LAST_INSERT_ID();

/* ADD EXAMPLE CUSTOMER ACCOUNTS Email : axtom77@hotmail.fr, PWD : admin123 */
INSERT INTO customer (firstname, lastname, email, password, vkey, verified, registration_date, update_date) 
   VALUES ('Tom', 'Virard', 'axtom77@hotmail.fr', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', '0192023a7bbd73250516f069df18b500', 1, NOW(), NOW());
SET @example_customer_id = LAST_INSERT_ID();

/* SETUP MULTIPLE EXAMPLE EVENTS (Without image) */
INSERT INTO image (url) VALUES ('../../uploads/image/test.png');
INSERT INTO event (type, start_time, end_time, title, description, address, admin_user_id, image_id) 
   VALUES ('Event Type 1', NOW(), NOW(), 'Event Title 1', 'Event Description 1', 'Event Address 1', @admin_user_id, LAST_INSERT_ID());
SET @example_event_id = LAST_INSERT_ID();

INSERT INTO image (url) VALUES ('../../uploads/image/test.png');
INSERT INTO event (type, start_time, end_time, title, description, address, admin_user_id, image_id) 
   VALUES ('Event Type 2', NOW(), DATE_ADD(NOW(), INTERVAL 3 DAY), 'Event Title 2', 'Event Description 2', 'Event Address 2', @admin_user_id, LAST_INSERT_ID());

/* SUBSCRIBE A CUSTOMER TO AN EVENT */
INSERT INTO subscribe (customer_id, event_id) VALUES (@example_customer_id, @example_event_id);

/* ADD EXAMPLE PRODUCT (Without image) */
INSERT INTO tax (rate) VALUES (20.00);
SET @tax_id = LAST_INSERT_ID();

INSERT INTO image (url) VALUES ('./../../website/graphics/img/logo.png');
SET @product_image_id = LAST_INSERT_ID();

INSERT INTO category (name, description) VALUES ('Category', 'Category description');
SET @category_id = LAST_INSERT_ID();

INSERT INTO product (name, short_description, long_description, price_excl_tax, stock_quantity, tax_id, image_id, category_id) 
   VALUES('Name 1', 'Short Description 1', 'Long Description 1', 45 , 15, @tax_id, @product_image_id, @category_id);
SET @example_product_id_1 = LAST_INSERT_ID();

INSERT INTO product (name, short_description, long_description, price_excl_tax, stock_quantity, tax_id, image_id, category_id) 
   VALUES('Name 2', 'Short Description 2', 'Long Description 2', 25 , 10, @tax_id, @product_image_id, @category_id);
SET @example_product_id_2 = LAST_INSERT_ID();

/* ADD EXAMPLE CUSTOMER VISIT LOGS */
INSERT INTO activity_log (action, created_at, customer_id) VALUES ('Visit : Home Page', NOW(), @example_customer_id), ('Visit : Events Page', NOW(), @example_customer_id);

/* ADD EXAMPLE CUSTOMER THREAD */
INSERT INTO thread (title, type, customer_id) VALUES ('Thread Title 1', 'Thread Type 1', @example_customer_id), ('Thread Title 2', 'Thread Type 2', @example_customer_id);
SET @example_thread_id = LAST_INSERT_ID();

/* ADD EXAMPLE CUSTOMER COMMENT TO A THREAD */
INSERT INTO user_comment (title, content, created_at, customer_id) VALUES ('Comment Title', 'Comment Content', NOW(), @example_customer_id);
SET @exmaple_user_comment_id_1 = LAST_INSERT_ID();

INSERT INTO populate (user_comment_id, thread_id) VALUES (@exmaple_user_comment_id_1, @example_thread_id);

/* ADD EXAMPLE CUSTOMER COMMENT TO A PRODUCT WITH A RATING */
INSERT INTO user_comment (title, content, created_at, customer_id) VALUES ('Comment Title', 'Comment Content', NOW(), @example_customer_id);
SET @exmaple_user_comment_id_2 = LAST_INSERT_ID();

INSERT INTO rating (score, user_comment_id) VALUES (4, @exmaple_user_comment_id_2);

INSERT INTO judge (product_id, user_comment_id) VALUES (@example_product_id_1, @exmaple_user_comment_id_2);

/* ADD EXAMPLE CUSTOMER COMMENT TO A PRODUCT */
INSERT INTO user_comment (title, content, created_at, customer_id) VALUES ('Comment Title', 'Comment Content', NOW(), @example_customer_id);
SET @exmaple_user_comment_id_3 = LAST_INSERT_ID();

INSERT INTO judge (product_id, user_comment_id) VALUES (@example_product_id_1, @exmaple_user_comment_id_3);

/* ADD EXAMPLE FACTURATION_ADDRESS */
INSERT INTO facturation_address (firstname, lastname, city, street, zip_code, email, more_info, phone_number) 
   VALUES ('FirstName', 'LastName', 'LONDON', '26 New Street', 'W10 9MQ', 'difallahadam2003@gmail.com','Building 7, 4th Floor, Door/Box 99', '+33 7 49 02 26 39');
SET @example_facturation_address = LAST_INSERT_ID();

/* ADD EXAMPLE COMMAND */
INSERT INTO command (card_last_digits, card_type, created_at, complete, facturation_address_id) VALUES (4726, 2, NOW(), 0, @example_facturation_address);
SET @example_command_id = LAST_INSERT_ID();

/* ADD EXAMPLE CUSTOMER_ADDRESS */
INSERT INTO delivery_address (firstname, lastname, city, street, zip_code, more_info, phone_number, customer_id) 
   VALUES ('FirstName', 'LastName', 'LONDON', '26 New Street', 'W10 9MQ', 'Building 7, 4th Floor, Door/Box 99', "+33 7 49 02 26 39", @example_customer_id);
SET @example_customer_address = LAST_INSERT_ID();

/* ADD EXAMPLE DELIVERY */
INSERT INTO delivery (status, tracking_number, delivery_line_link,command_id, customer_address_id)
   VALUES ("In Preparation", 'SL3MEKG7M9D9F', 'https://www.google.com', @example_command_id, @example_customer_address);

/* ADD EXAMPLE PRODUCT ORDERS */
INSERT INTO product_order (quantity, command_id, product_id) 
   VALUES (2, @example_command_id, @example_product_id_1);
SET @example_product_order_id_1 = LAST_INSERT_ID();

INSERT INTO product_order (quantity, command_id, product_id) 
   VALUES (4, @example_command_id, @example_product_id_2);
SET @example_product_order_id_2 = LAST_INSERT_ID();

/* ADD EXAMPLE SHIPPING COST */
INSERT INTO shipping_cost (price, product_order_id) VALUES (4.99, @example_product_order_id_1);

/* ADD EXAMPLE SHIPPING COST */
INSERT INTO shipping_cost (price, product_order_id) VALUES (3.99, @example_product_order_id_2);

/* ADD COMMAND RESERVATION BY CUSTOMER */
INSERT INTO reserve (customer_id, command_id) VALUES (@example_customer_id, @example_command_id);
