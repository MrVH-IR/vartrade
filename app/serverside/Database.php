<?php

$SER_ADD = "localhost";
$SER_PORT = "3306";
$SER_USER = "root";
$SER_PASS = "root";

try {
    $conn = new PDO("mysql:$SER_ADD;port:$SER_PORT",$SER_USER,$SER_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {
    echo "No DB Conn". $e->getMessage();
}

function connDB() {
    global $conn;
    try {
        return $conn;
    } catch(PDOException $e) {
        echo "Can't Conn To DB". $e->getMessage();
    }
}

function runQueries() {
    
}

?>