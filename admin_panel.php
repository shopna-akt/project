<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "Access denied";
    exit;
}
echo "<h2>Admin Panel</h2>";
// Add medicine, view users, manage orders here
?>
