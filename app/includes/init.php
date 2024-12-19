<?php
if (headers_sent()) {
    die("Headers already sent. Check the code for unexpected output.");
}
if (!session_start()) {
    die("Failed to start the session");
}

session_start();
$guest = false;
$user_id = false;
$admin_id = false;

if (isset($_SESSION["user_id"])) {
    $user_id = true;
} elseif (isset($_SESSION["admin_id"])) {
    $admin_id = true;
} elseif (empty($_SESSION)) {
    $guest = true;
}
