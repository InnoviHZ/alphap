<?php
include "../../assets/include/config.php";

$query = "SELECT * FROM _PDUsers";
$result = mysqli_query($conn, $query);

$beneficiaries = array();

while ($row = mysqli_fetch_assoc($result)) {
    $beneficiaries[] = $row;
}

echo json_encode($beneficiaries);

mysqli_close($conn);
?>