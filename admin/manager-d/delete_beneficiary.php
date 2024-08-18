<?php
include "../../assets/include/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "DELETE FROM _PDUsers WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "Beneficiary deleted successfully";
    } else {
        echo "Error deleting beneficiary: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>