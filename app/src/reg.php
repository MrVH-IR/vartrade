<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require "../template/auth/reg.tpl";
require "../includes/init.php";
require "../serverside/Database.php";
var_dump($_SESSION);

if ($user_id == 0 && $admin_id == 0) {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirmPassword'];

        if ($password !== $confirmPass) {
            echo "Passwords Do Not Match";
            die();
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }
        try {
            global $conn;
            $sql = "INSERT INTO var_users (firstname,lastname,username,password)
            VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $fullname, $lastname, $email, $hashedPassword);
            $stmt->execute();
            $stmt->close();
            echo "User Registered Successfully!";
        } catch (PDOException $e) {
            echo "Registraion Failed -> " . $e->getMessage();
        }
    }
} else {
    echo "U R Already Registered";
    header("Location: ./Index.php");
    die();
}
