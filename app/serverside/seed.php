<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "./query.php";

$conn->exec("USE $SER_DB");
$firstname = "Mr";
$lastname = "VH";
$username = "MrVH";
$password = "1234567890";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
//Admin Acc
try {
    $sql = "INSERT INTO var_users(
    firstname,lastname,username,password) 
    VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$firstname, $lastname, $username, $hashed_password]);
    echo "Insert To Users Was a Succsess";
} catch (PDOException $e) {
    echo "Failed To Insert To USERS -> " . $e->getMessage();
}
