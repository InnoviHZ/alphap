<?php
session_start();
include "../../assets/include/config.php";

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'ADMIN') {
    header('HTTP/1.0 403 Forbidden');
    exit('Access denied');
}

$sql = "SELECT id, name, email FROM _PDAdmin WHERE type = 'MANAGER'";
$result = $conn->query($sql);

$managers = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $managers[] = $row;
    }
}

echo json_encode($managers);
?>