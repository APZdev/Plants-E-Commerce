
DROP DATABASE IF EXISTS tropicalinterior;
CREATE DATABASE IF NOT EXISTS tropicalinterior;
USE tropicalinterior;
/* ctrl + f : MEDIUMINT AUTO_INCREMENT for MEDIUMINT AUTO_INCREMENT */


CREATE TABLE customer_address(
   customer_address_id INT,
   firstname VARCHAR(50) ,
   lastname VARCHAR(50) ,
   city VARCHAR(50)  NOT NULL,
   street VARCHAR(255)  NOT NULL,
   zip_code INT NOT NULL,
   apartment_number VARCHAR(255)  NOT NULL,
   more_info VARCHAR(255) ,
   PRIMARY KEY(customer_address_id)
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

CREATE TABLE command(
   command_id INT AUTO_INCREMENT,
   card_last_digits INT NOT NULL,
   card_type VARCHAR(15)  NOT NULL,
   created_at DATETIME NOT NULL,
   PRIMARY KEY(command_id)
);

CREATE TABLE customer(
   customer_id VARCHAR(50) ,
   firstname VARCHAR(50)  NOT NULL,
   lastname VARCHAR(50)  NOT NULL,
   email VARCHAR(255)  NOT NULL,
   password VARCHAR(32)  NOT NULL,
   vkey VARCHAR(32)  NOT NULL,
   verified BOOLEAN NOT NULL,
   registration_date DATETIME NOT NULL,
   update_date VARCHAR(50) ,
   customer_address_id INT NOT NULL,
   PRIMARY KEY(customer_id),
   FOREIGN KEY(customer_address_id) REFERENCES customer_address(customer_address_id)
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
   delivery_date DATE NOT NULL,
   status VARCHAR(50)  NOT NULL,
   delivered_date DATETIME,
   command_id INT NOT NULL,
   customer_address_id INT NOT NULL,
   PRIMARY KEY(delivery_id),
   FOREIGN KEY(command_id) REFERENCES command(command_id),
   FOREIGN KEY(customer_address_id) REFERENCES customer_address(customer_address_id)
);

CREATE TABLE shipping_cost(
   shipping_cost_id INT AUTO_INCREMENT,
   price DECIMAL(15,2)   NOT NULL,
   product_order_id INT NOT NULL,
   PRIMARY KEY(shipping_cost_id),
   UNIQUE(product_order_id),
   FOREIGN KEY(product_order_id) REFERENCES product_order(product_order_id)
);

CREATE TABLE thread(
   thread_id INT AUTO_INCREMENT,
   title VARCHAR(50)  NOT NULL,
   type VARCHAR(100)  NOT NULL,
   customer_id VARCHAR(50)  NOT NULL,
   PRIMARY KEY(thread_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE visit_log(
   visit_log_id INT AUTO_INCREMENT,
   location VARCHAR(50)  NOT NULL,
   created_at DATETIME NOT NULL,
   customer_id VARCHAR(50)  NOT NULL,
   PRIMARY KEY(visit_log_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE user_comment(
   user_comment_id INT AUTO_INCREMENT,
   title VARCHAR(100)  NOT NULL,
   content VARCHAR(250)  NOT NULL,
   created_at DATETIME NOT NULL,
   customer_id VARCHAR(50)  NOT NULL,
   thread_id INT NOT NULL,
   product_id INT NOT NULL,
   PRIMARY KEY(user_comment_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id),
   FOREIGN KEY(thread_id) REFERENCES thread(thread_id),
   FOREIGN KEY(product_id) REFERENCES product(product_id)
);

CREATE TABLE rating(
   rating_id INT AUTO_INCREMENT,
   score INT NOT NULL,
   user_comment_id INT NOT NULL,
   PRIMARY KEY(rating_id),
   UNIQUE(user_comment_id),
   FOREIGN KEY(user_comment_id) REFERENCES user_comment(user_comment_id)
);

CREATE TABLE reserve(
   customer_id VARCHAR(50) ,
   command_id INT,
   PRIMARY KEY(customer_id, command_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id),
   FOREIGN KEY(command_id) REFERENCES command(command_id)
);

CREATE TABLE subscribe(
   customer_id VARCHAR(50) ,
   event_id INT,
   PRIMARY KEY(customer_id, event_id),
   FOREIGN KEY(customer_id) REFERENCES customer(customer_id),
   FOREIGN KEY(event_id) REFERENCES event(event_id)
);



/* SETUP DEFAULT ADMIN ACCOUNTS */

INSERT INTO admin_user (email, password) VALUES ('admin1@localhost.fr', 'admin123'), ('admin2@localhost.fr', 'admin123');

