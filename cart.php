<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['add_to_cart'])) {
    $medicine_id = $_POST['add_to_cart'];
    $qty = $_POST['qty'][$medicine_id];

    if ($qty > 0) {
        $_SESSION['cart'][$medicine_id] = $qty;
        header("Location: view_cart.php");
        exit;
    } else {
        echo "Invalid quantity.";
    }
}
?>