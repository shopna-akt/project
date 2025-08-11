<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<h2>Admin Dashboard</h2>
<ul>
    <li><a href="manage_users.php">Manage Users</a></li>
    <li><a href="manage_medicines.php">Manage Medicines</a></li>
    <li><a href="manage_orders.php">Manage Orders</a></li>
    <li><a href="manage_users.php">Manage Users</a></li>

</ul>
<a href="logout.php">Logout</a>

