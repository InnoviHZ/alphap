<?php
session_start();
include "../../assets/include/config.php";

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $sql = "SELECT name, email, type, picture FROM _PDAdmin WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $profile = $result->fetch_assoc();
        echo json_encode($profile);
    } else {
        echo json_encode(['error' => 'Profile not found']);
    }
} else {
    echo json_encode(['error' => 'Not logged in']);
}
?>