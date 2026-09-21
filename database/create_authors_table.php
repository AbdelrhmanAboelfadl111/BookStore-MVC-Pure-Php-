<?php
require_once __DIR__ . "/../core/DataBase.php";
class create_authors_table{
    public static function build(){ 
        Database::getConnection()->exec("CREATE TABLE IF NOT EXISTS authors(
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            bio TEXT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }
    public static function harmful(){
        Database::getConnection()->exec("DROP TABLE IF EXISTS authors");
    }
}