<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "Cart is empty.";
    exit;
}

echo "<h2>Your Cart</h2>";
echo "<form method='POST'>";
$total = 0;

foreach ($_SESSION['cart'] as $med_id => $qty) {
    $res = $conn->query("SELECT * FROM medicines WHERE id = $med_id");
    $med = $res->fetch_assoc();

    $subtotal = $qty * $med['price'];
    $total += $subtotal;

    echo "<p>{$med['name']} - $qty x {$med['price']} = $subtotal</p>";
}

echo "<h3>Total: $total</h3>";
echo "<button type='submit' name='place_order'>Place Order</button>";
echo "</form>";

echo "<form method='POST' action='submit_review.php'>";
echo "<label>Rate this order (1-5):</label><br>";
echo "<input type='number' name='rating' min='1' max='5'><br>";
echo "<label>Leave a review:</label><br>";
echo "<textarea name='review'></textarea><br>";
echo "<input type='submit' value='Submit Review'>";
echo "</form>";

if (isset($_POST['place_order'])) {
    $user_id = $_SESSION['user_id'];

    foreach ($_SESSION['cart'] as $med_id => $qty) {
        $stmt = $conn->prepare("INSERT INTO orders (user_id, medicine_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $med_id, $qty);
        $stmt->execute();

        $conn->query("UPDATE medicines SET stock = stock - $qty WHERE id = $med_id");
    }

    unset($_SESSION['cart']);
    echo "<p>Order placed successfully!</p>";
    echo "<a href='dashboard.php'>Back to Dashboard</a>";
}
?>
