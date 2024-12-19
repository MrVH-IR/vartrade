<?php

$SER_ADD = "127.0.0.1";
$SER_PORT = "3306";
$SER_USER = "root";
$SER_PASS = "root";

try {
    // Connect to MySQL server
    $conn = new PDO("mysql:host=$SER_ADD;port=$SER_PORT", $SER_USER, $SER_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    echo "Conn To Be _)_";
} catch (PDOException $e) {
    echo "No DB Conn: " . $e->getMessage();
}

function connDB()
{
    global $conn;
    try {
        return $conn;
    } catch (PDOException $e) {
        echo "Can't Conn To DB" . $e->getMessage();
    }
}
