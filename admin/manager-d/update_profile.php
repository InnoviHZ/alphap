<?php
session_start();
include "../../assets/include/config.php";

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE _PDAdmin SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $email, $admin_id);
    
    if ($stmt->execute()) {
        $_SESSION['admin_name'] = $name;
        $_SESSION['admin_email'] = $email;

        // Handle profile picture upload
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
            $target_dir = "uploads/";
            $file_extension = pathinfo($_FILES["profilePicture"]["name"], PATHINFO_EXTENSION);
            $new_filename = uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file)) {
                $sql = "UPDATE _PDAdmin SET picture = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $new_filename, $admin_id);
                $stmt->execute();
                $_SESSION['admin_picture'] = $new_filename;
                echo json_encode(['success' => true, 'picture' => $new_filename]);
            } else {
                echo json_encode(['error' => 'Failed to upload profile picture']);
            }
        } else {
            echo json_encode(['success' => true]);
        }
    } else {
        echo json_encode(['error' => 'Failed to update profile']);
    }
} else {
    echo json_encode(['error' => 'Not logged in']);
}
?>