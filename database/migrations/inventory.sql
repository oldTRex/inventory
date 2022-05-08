CREATE TABLE `category`  (
  `id` int NOT NULL,
  `name` varchar(255) NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `inventory`  (
  `id` int NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `item`  (
  `item_code` int NOT NULL,
  `item_description` varchar(255) NULL,
  `category_id` int NULL,
  `warehouse_location_id` int NULL,
  `rack_location_id` int NULL,
  `unit_measure` varchar(255) NULL,
  `unit_purchase_cost` decimal(9) NULL,
  `unit_landing_cost` decimal(9) NULL,
  `unit_sales_cost` decimal(9, 2) NULL,
  `image` varchar(255) NULL,
  `low_level_stock` varchar(255) NULL,
  PRIMARY KEY (`item_code`)
);

CREATE TABLE `location`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NULL,
  `type` varchar(255) NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `receive`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NULL,
  `receive_date` datetime(0) NULL,
  `item_code` int NULL,
  `description` varchar(255) NULL,
  `additional_note` varchar(255) NULL,
  `received_quantity` decimal(9, 0) NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `sale`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NULL,
  `date_of_sale` datetime(0) NULL,
  `item_code` int NULL,
  `item_description` varchar(255) NULL,
  `sell_quantity` decimal(9, 0) NULL,
  `delivery_note_no` varchar(0) NULL,
  `invoice_no` varchar(0) NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NULL,
  `name` varchar(255) NULL,
  `password_text` varchar(255) NULL,
  `role` varchar(255) NULL,
  `api_key` varchar(100) NULL,
  `remember_token ` varchar(255) NULL,
  PRIMARY KEY (`user_id`)
);

ALTER TABLE `item` ADD CONSTRAINT `fk_item_item_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
ALTER TABLE `item` ADD CONSTRAINT `fk_item_item_2` FOREIGN KEY (`warehouse_location_id`) REFERENCES `location` (`id`);
ALTER TABLE `item` ADD CONSTRAINT `fk_item_item_3` FOREIGN KEY (`rack_location_id`) REFERENCES `location` (`id`);
ALTER TABLE `recieve` ADD CONSTRAINT `fk_recieve_recieve_1` FOREIGN KEY (`item_code`) REFERENCES `item` (`item_code`);
ALTER TABLE `sale` ADD CONSTRAINT `fk_sale_sale_1` FOREIGN KEY (`item_code`) REFERENCES `item` (`item_code`);

