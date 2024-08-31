<?php
include "../../assets/include/config.php";

$sql = "SELECT id, name, email, type AS admin_type FROM _PDAdmin";
$result = $conn->query($sql);

$admins = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
}

echo json_encode($admins);
$conn->close();
?>