<?php include("includes/db.php"); session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Medicines</title>
</head>
<body>
<h2>Search Medicines</h2>
<form method="GET" action="">
  <input type="text" name="search" placeholder="Enter medicine name">
  <button type="submit">Search</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>

<?php
$query = "SELECT * FROM medicines";
if (isset($_GET['search']) && $_GET['search'] != "") {
    $search = $_GET['search'];
    $query = "SELECT * FROM medicines WHERE name LIKE '%$search%'";
}
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<form method='POST' action='cart.php'>";
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Stock</th><th>Quantity</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
                <td>{$row['price']}</td>
                <td>{$row['stock']}</td>
                <td><input type='number' name='qty[{$row['id']}]' min='1' max='{$row['stock']}'></td>
                <td><button type='submit' name='add_to_cart' value='{$row['id']}'>Add to Cart</button></td>
              </tr>";
    }
    echo "</table></form>";
} else {
    echo "No medicines found.";
}
?>
</body>
</html>