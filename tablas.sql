-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema convertidora_continentall
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema convertidora_continental
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `convertidora_continental` DEFAULT CHARACTER SET utf8 ;
USE `convertidora_continental` ;

-- -----------------------------------------------------
-- Table `convertidora_continental`.`clients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`clients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`parameters`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`parameters` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `value` VARCHAR(45) NULL,
  `system` INT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`client_addresses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`client_addresses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `reference` VARCHAR(150) NULL,
  `state` VARCHAR(50) NULL,
  `city` VARCHAR(50) NULL,
  `colony` VARCHAR(45) NULL,
  `postal_code` VARCHAR(45) NULL,
  `address` VARCHAR(255) NULL,
  `telephone` VARCHAR(45) NULL,
  `rfc` VARCHAR(45) NULL,
  `client_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  INDEX `fk_direcctions_clients_clients1_idx` (`client_id` ASC) ,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_direcctions_clients_clients1`
    FOREIGN KEY (`client_id`)
    REFERENCES `convertidora_continental`.`clients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`sales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`sales` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `order_id` VARCHAR(45) NULL,
  `paymen_status` VARCHAR(45) NULL,
  `payment_method` VARCHAR(45) NULL,
  `total` DECIMAL(10,2) NULL,
  `client_id` INT NOT NULL,
  `status_id` INT NOT NULL,
  `client_address_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sale_clients1_idx` (`client_id` ASC) ,
  INDEX `fk_sale_Parameters1_idx` (`status_id` ASC) ,
  INDEX `fk_sales_direcctions_clients1_idx` (`client_address_id` ASC) ,
  CONSTRAINT `fk_sale_clients1`
    FOREIGN KEY (`client_id`)
    REFERENCES `convertidora_continental`.`clients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sale_Parameters1`
    FOREIGN KEY (`status_id`)
    REFERENCES `convertidora_continental`.`parameters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sales_direcctions_clients1`
    FOREIGN KEY (`client_address_id`)
    REFERENCES `convertidora_continental`.`client_addresses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `client_id` INT NOT NULL,
  `sale_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_orders_clients1_idx` (`client_id` ASC) ,
  INDEX `fk_orders_sale1_idx` (`sale_id` ASC) ,
  CONSTRAINT `fk_orders_clients1`
    FOREIGN KEY (`client_id`)
    REFERENCES `convertidora_continental`.`clients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_sale1`
    FOREIGN KEY (`sale_id`)
    REFERENCES `convertidora_continental`.`sales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`storages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`storages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(150) NULL,
  `status` INT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `code` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  `status` INT NULL,
  `cost` DECIMAL(10,2) NULL,
  `price_cost` DECIMAL(10,2) NULL,
  `price_unit` DECIMAL(10,2) NULL,
  `price_wholesale` DECIMAL(10,2) NULL,
  `price_special` DECIMAL(10,2) NULL,
  `color_id` INT NOT NULL,
  `status_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL COMMENT '	',
  PRIMARY KEY (`id`),
  INDEX `fk_products_Parameters1_idx` (`color_id` ASC) ,
  INDEX `fk_products_Parameters2_idx` (`status_id` ASC) ,
  INDEX `fk_products_categories1_idx` (`category_id` ASC) ,
  CONSTRAINT `fk_products_Parameters1`
    FOREIGN KEY (`color_id`)
    REFERENCES `convertidora_continental`.`parameters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_Parameters2`
    FOREIGN KEY (`status_id`)
    REFERENCES `convertidora_continental`.`parameters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `convertidora_continental`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`transfers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`transfers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quantity` INT NULL,
  `product_id` INT NOT NULL,
  `storage_id_origin` INT NOT NULL,
  `storage_id_detiny` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_transfers_Storage1_idx` (`storage_id_origin` ASC) ,
  INDEX `fk_transfers_products1_idx` (`product_id` ASC) ,
  INDEX `fk_transfers_Storage2_idx` (`storage_id_detiny` ASC) ,
  CONSTRAINT `fk_transfers_Storage1`
    FOREIGN KEY (`storage_id_origin`)
    REFERENCES `convertidora_continental`.`storages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transfers_products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `convertidora_continental`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transfers_Storage2`
    FOREIGN KEY (`storage_id_detiny`)
    REFERENCES `convertidora_continental`.`storages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`user_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`user_types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NULL,
  `status` INT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `user_type_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_user_type1_idx` (`user_type_id` ASC) ,
  CONSTRAINT `fk_users_user_type1`
    FOREIGN KEY (`user_type_id`)
    REFERENCES `convertidora_continental`.`user_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`audit_logs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`audit_logs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(150) NULL,
  `user_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_audit_logs_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_audit_logs_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `convertidora_continental`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`providers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`providers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `direction` VARCHAR(150) NULL,
  `phone` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`packagings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`packagings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `type` VARCHAR(45) NULL,
  `provider_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_packaging_providres1_idx` (`provider_id` ASC) ,
  CONSTRAINT `fk_packaging_providres1`
    FOREIGN KEY (`provider_id`)
    REFERENCES `convertidora_continental`.`providers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`products_invetories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`products_invetories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quantity` INT NULL,
  `quantity_per_packaging` INT NULL,
  `product_id` INT NOT NULL,
  `packaging_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_stocks_products_idx` (`product_id` ASC) ,
  INDEX `fk_products_invetory_packaging1_idx` (`packaging_id` ASC) ,
  CONSTRAINT `fk_stocks_products`
    FOREIGN KEY (`product_id`)
    REFERENCES `convertidora_continental`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_invetory_packaging1`
    FOREIGN KEY (`packaging_id`)
    REFERENCES `convertidora_continental`.`packagings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`raw_materials`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`raw_materials` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `code` VARCHAR(45) NULL,
  `provider_id` INT NOT NULL,
  `unit_type_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_raw_material_providres1_idx` (`provider_id` ASC) ,
  INDEX `fk_raw_material_Parameters2_idx` (`unit_type_id` ASC) ,
  CONSTRAINT `fk_raw_material_providres1`
    FOREIGN KEY (`provider_id`)
    REFERENCES `convertidora_continental`.`providers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_raw_material_Parameters2`
    FOREIGN KEY (`unit_type_id`)
    REFERENCES `convertidora_continental`.`parameters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`raw_material_inventory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`raw_material_inventory` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(150) NULL,
  `raw_material_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_raw_material_inventory_raw_material1_idx` (`raw_material_id` ASC) ,
  CONSTRAINT `fk_raw_material_inventory_raw_material1`
    FOREIGN KEY (`raw_material_id`)
    REFERENCES `convertidora_continental`.`raw_materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`order_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`order_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `quantity` DECIMAL(10,2) NULL,
  `price` DECIMAL(10) NULL,
  `total` DECIMAL(10) NULL,
  `orders_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_order_details_orders1_idx` (`orders_id` ASC) ,
  INDEX `fk_order_details_products1_idx` (`product_id` ASC) ,
  CONSTRAINT `fk_order_details_orders1`
    FOREIGN KEY (`orders_id`)
    REFERENCES `convertidora_continental`.`orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_details_products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `convertidora_continental`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`ofers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`ofers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `description` TEXT NULL,
  `discount_percentage` DECIMAL(10,2) NULL,
  `start_date` DATE NULL,
  `end_date` DATE NULL,
  `status` INT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`payment_methods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`payment_methods` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `amount` DECIMAL(10,2) NULL,
  `method_id` INT NOT NULL,
  `client_id` INT NOT NULL,
  `account_type_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_payment_methods_Parameters1_idx` (`method_id` ASC) ,
  INDEX `fk_payment_methods_clients1_idx` (`client_id` ASC) ,
  INDEX `fk_payment_methods_parameters2_idx` (`account_type_id` ASC) ,
  CONSTRAINT `fk_payment_methods_Parameters1`
    FOREIGN KEY (`method_id`)
    REFERENCES `convertidora_continental`.`parameters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payment_methods_clients1`
    FOREIGN KEY (`client_id`)
    REFERENCES `convertidora_continental`.`clients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payment_methods_parameters2`
    FOREIGN KEY (`account_type_id`)
    REFERENCES `convertidora_continental`.`parameters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`moduls`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`moduls` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `route` VARCHAR(150) NULL,
  `icon` VARCHAR(45) NULL,
  `status` INT NULL,
  `department` VARCHAR(150) NULL,
  `position` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`module_user_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`module_user_types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `view` VARCHAR(45) NULL,
  `edit` VARCHAR(45) NULL,
  `user_type_id` INT NOT NULL,
  `module_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_moduls_type_users_user_type1_idx` (`user_type_id` ASC) ,
  INDEX `fk_moduls_type_users_moduls1_idx` (`module_id` ASC) ,
  CONSTRAINT `fk_moduls_type_users_user_type1`
    FOREIGN KEY (`user_type_id`)
    REFERENCES `convertidora_continental`.`user_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_moduls_type_users_moduls1`
    FOREIGN KEY (`module_id`)
    REFERENCES `convertidora_continental`.`moduls` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`bank_acount_clients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`bank_acount_clients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `client_id` INT NOT NULL,
  `bank_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  `bank_acount_clientscol` VARCHAR(45) NULL,
  `bank_acount_clients_id` INT NOT NULL,
  INDEX `fk_bank_acount_clients1_idx` (`client_id` ASC) ,
  PRIMARY KEY (`id`),
  INDEX `fk_bank_acount_clients_parameters1_idx` (`bank_id` ASC) ,
  INDEX `fk_bank_acount_clients_bank_acount_clients1_idx` (`bank_acount_clients_id` ASC) ,
  CONSTRAINT `fk_bank_acount_clients1`
    FOREIGN KEY (`client_id`)
    REFERENCES `convertidora_continental`.`clients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bank_acount_clients_parameters1`
    FOREIGN KEY (`bank_id`)
    REFERENCES `convertidora_continental`.`parameters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bank_acount_clients_bank_acount_clients1`
    FOREIGN KEY (`bank_acount_clients_id`)
    REFERENCES `convertidora_continental`.`bank_acount_clients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`product_offers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`product_offers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `offer_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_offers_ofers1_idx` (`offer_id` ASC) ,
  INDEX `fk_product_offers_products1_idx` (`product_id` ASC) ,
  CONSTRAINT `fk_product_offers_ofers1`
    FOREIGN KEY (`offer_id`)
    REFERENCES `convertidora_continental`.`ofers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_offers_products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `convertidora_continental`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`sale_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`sale_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `sale_datail_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sale_details_sale_datai1_idx` (`sale_datail_id` ASC) ,
  CONSTRAINT `fk_sale_details_sale_datai1`
    FOREIGN KEY (`sale_datail_id`)
    REFERENCES `convertidora_continental`.`sales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `convertidora_continental`.`provider_addresses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `convertidora_continental`.`provider_addresses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `reference` VARCHAR(150) NULL,
  `state` VARCHAR(50) NULL,
  `city` VARCHAR(50) NULL,
  `colony` VARCHAR(45) NULL,
  `postal_code` VARCHAR(45) NULL,
  `address` VARCHAR(255) NULL,
  `telephone` VARCHAR(45) NULL,
  `rfc` VARCHAR(45) NULL,
  `providers_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `deleted_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_provider_addresses_providers1_idx` (`providers_id` ASC) ,
  CONSTRAINT `fk_provider_addresses_providers1`
    FOREIGN KEY (`providers_id`)
    REFERENCES `convertidora_continental`.`providers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
