<?php
include "../../assets/include/config.php";

$sql = "SELECT id, name, email, date_registered FROM _PDManagers";
$result = $conn->query($sql);

$managers = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $managers[] = $row;
    }
}

echo json_encode($managers);
$conn->close();
?>