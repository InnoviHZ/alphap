<?php
include "../../assets/include/config.php";
session_start();

$table = $_GET['table'];
$data = array();

switch ($table) {
    case 'beneficiary':
        $sql = "SELECT * FROM _PDUsers";
        break;
    case 'admin':
        $sql = "SELECT * FROM _PDAdmin WHERE type = 'REGULAR_ADMIN'";
        break;
    case 'manager':
        $sql = "SELECT * FROM _PDAdmin WHERE type = 'MANAGER'";
        break;
    case 'superAdmin':
        $sql = "SELECT * FROM _PDAdmin WHERE type = 'SUPER_ADMIN'";
        break;
    default:
        echo json_encode(array('error' => 'Invalid table selected'));
        exit;
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>