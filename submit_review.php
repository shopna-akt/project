<?php
session_start();
include "db.php";
if (isset($_POST['rating']) && isset($_POST['review']) && isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    mysqli_query($conn, "INSERT INTO reviews (user_id, rating, review) VALUES ('$uid', '$rating', '$review')");
    echo "Thanks for your feedback!";
}
?>
