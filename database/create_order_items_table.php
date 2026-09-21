<?php
require_once __DIR__ . "/../core/DataBase.php";
class create_order_items_table{
    public static function build(){ 
        Database::getConnection()->exec("CREATE TABLE IF NOT EXISTS order_items(
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            order_id BIGINT UNSIGNED NOT NULL,
            CONSTRAINT fk_order_id FOREIGN KEY (order_id) REFERENCES  orders(id),
            book_id BIGINT UNSIGNED NOT NULL,
            CONSTRAINT fk_book_id FOREIGN KEY (book_id) REFERENCES  books(id),
            quantity INT UNSIGNED,
            unit_price DECIMAL(10,2),
            subtotal DECIMAL(10,2),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }
    public static function harmful(){
        Database::getConnection()->exec("DROP TABLE IF EXISTS order_items");
    }
}