<?php
Global $conn;
$SER_DB = "vartrade_main";
//DB Creation
try {
    $sql = $conn->("CREATE DATABASE IF NOT EXISTS $SER_DB");
    $stmt->$conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "DB has been Created -> ". $SER_DB;
} catch(PDOEXception $e) {
    echo "No DB Can Be Created". $e->getMessage();
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
    )";
    $conn->exec($sql);
    echo "Table users has been created";
} catch (PDOEXception $e) {
    echo "No Table Can Be Created". $e->getMessage();
}
//coins
try {
    $sql = "CREATE TABLE IF NOT EXISTS var_coins (
    id INT AUTO_INCREMENT PRIMARY KEy,
    coin_name VARCHAR(50) NOT NULL)";
    $conn->exec($sql);
    echo "Table coins has been created";
} catch (PDOException $e) {
    echo "No Table Can Be Created". $e->getMessage();
}
//prices
try {
    $sql = "CREATE TABLE IF NOT EXISTS var_prices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    price INT(50) NOT NULL,
    coin_id FOREIGN KEY REFRENCES coin_name.id)";
    $conn->exec($sql);
    echo "Table prices has been created";
} catch (PDOException $e) {
    echo "No Table Can Be Created". $e->getMessage();
}