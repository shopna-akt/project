<?php
session_start();
if ($_SESSION['role'] != 'pharmacist') {
    echo "Access denied";
    exit;
}
echo "<h2>Pharmacist Dashboard</h2>";
// View orders, consult via WhatsApp etc.
?>
