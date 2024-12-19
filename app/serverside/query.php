<?php
include "./Database.php";
error_reporting(E_ALL);
ini_set("display_errors", 1);
global $conn;
$SER_DB = "vartrade_main";
//DB Creation
try {
    $sql = "CREATE DATABASE IF NOT EXISTS $SER_DB";
    $conn->exec($sql);
    echo "DB has been Created -> " . $SER_DB . "\n";
} catch (PDOException $e) {
    echo "No DB Can Be Created: " . $e->getMessage();
}

$conn->exec("USE $SER_DB");
//api
try {
    $sql = "CREATE TABLE IF NOT EXISTS api (
        id INT AUTO_INCREMENT PRIMARY KEY,
        api_company VARCHAR(50),
        api TEXT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $conn->exec($sql);
    echo "Table api has been created\n";
} catch (PDOException $e) {
    echo "Table api Can't Be Created: " . $e->getMessage();
}
//coins
try {
    $sql = "CREATE TABLE IF NOT EXISTS var_coins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        coin_name VARCHAR(50) NOT NULL,
        description TEXT NOT NULL,
        ImgPath TEXT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $conn->exec($sql);
    echo "Table coins has been created\n";
} catch (PDOException $e) {
    echo "Table coins Can't Be Created: " . $e->getMessage();
}
//users
try {
    $sql = "CREATE TABLE IF NOT EXISTS var_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $conn->exec($sql);
    echo "Table users has been created\n";
} catch (PDOException $e) {
    echo "Table users Can't Be Created: " . $e->getMessage();
}
// prices
try {
    $sql = "CREATE TABLE IF NOT EXISTS var_prices (
        id INT AUTO_INCREMENT PRIMARY KEY,
        price DECIMAL(10, 2) NOT NULL,
        coin_id INT,
        api_id INT,
        FOREIGN KEY (coin_id) REFERENCES var_coins(id),
        FOREIGN KEY (api_id) REFERENCES api(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    $conn->exec($sql);
    echo "Table prices has been created\n";
} catch (PDOException $e) {
    echo "Table prices Can't Be Created: " . $e->getMessage();
}
//modify users
try {
    $sql = "ALTER TABLE var_users MODIFY password VARCHAR(255) NOT NULL";
    $conn->exec($sql);
    echo "Password column size updated successfully.\n";
} catch (PDOException $e) {
    echo "Failed to update password column size: " . $e->getMessage();
}
