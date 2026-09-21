<?php
require_once __DIR__ . "/../core/DataBase.php";
class create_orders_table{
    public static function build(){ 
        Database::getConnection()->exec("CREATE TABLE IF NOT EXISTS orders(
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            customer_id BIGINT UNSIGNED NOT NULL,
            CONSTRAINT fk_customer_id FOREIGN KEY (customer_id) REFERENCES  users(id),  
            status Enum('pending', 'ordered', 'canceled', 'done') NOT NULL DEFAULT 'pending',
            cancel_reason TEXT NULL,
            total_price DECIMAL(10,2) DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }
    public static function harmful(){
        Database::getConnection()->exec("DROP TABLE IF EXISTS orders");
    }
}