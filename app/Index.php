<?php
include "./includes/init.php";
if (!$user_id == false) {
    echo "Welcome User";
} elseif(!$admin_id == false) {
    echo "Welcome Admin";
} elseif(!$guest == false) {
    echo "Welecome Guest";
}
?>