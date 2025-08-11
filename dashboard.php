
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
echo "<h2>Welcome User!</h2>";
echo "<a href='medicine.php'>Browse Medicines</a><br>";
echo "<a href='view_cart.php'>View Cart</a><br>";
echo "<a href='logout.php'>Logout</a>";

?>
