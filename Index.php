<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ./public/Index.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>صفحه اصلی</title>
</head>
<body>
    <h1>خوش آمدید به صفحه اصلی!</h1>
    <p>این صفحه فقط برای کاربرانی که لاگین کرده‌اند قابل دسترسی است.</p>
</body>
</html>