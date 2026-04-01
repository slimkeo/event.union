<?php
// =============================================
// FILE: config.php
// =============================================
$host     = "localhost";
$db_user  = "snatbur1_user";
$db_pass  = "Snatburial2025!";
$db_name  = "snatbur1_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>