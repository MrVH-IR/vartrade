<?php
class Database
{
    private static $SER_ADD = "127.0.0.1";
    private static $SER_USER = "root";
    private static $SER_PASS = "root";
    private static $SER_PORT = "3306";
    private static $SER_DB = "var_main";

    public static function connToDB()
    {
        try {
            $conn = new PDO("mysql:host=" . self::$SER_ADD . ";dbname=" . self::$SER_DB, self::$SER_USER, self::$SER_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (PDOException $e) {
            echo "Conn Failed";
        }
    }

    public static function insertToUsers($name, $email, $password)
    {
        try {
            $pdo = self::connToDB();
            $query = "INSERT INTO var_users (name , email , password) VALUES (:name , :email , :password)";
            $stmt = $pdo->prepare($query);
            $stmt->bindparam(':name', $name);
            $stmt->bindparam(':email', $email);
            $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
            $stmt->execute();
            return true;
        } catch (PDOException) {
            echo "Server Error";
            return false;
        }
    }
    public static function selectFromUsers($user_id)
    {
        try {
            $pdo = self::connToDB();
            $query = "SELECT * FROM var_users WHERE user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindparam(':user_id', $user_id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException) {
            echo "Server Error";
        }
    }

    public static function DeleteFromUsers($user_id)
    {
        try {
            $pdo = self::connToDB();
            $query = "DELETE FROM var_users WHERE user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindparam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            echo "Server Error";
            return false;
        }
    }
}
