<?php
session_start();
include "../../assets/include/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Consider hashing this password
    $type = "MANAGER";

    // File upload handling
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(["success" => false, "message" => "File is not an image."]);
        exit;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo json_encode(["success" => false, "message" => "Sorry, your file is too large."]);
        exit;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo json_encode(["success" => false, "message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."]);
        exit;
    }

    // if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $photo = basename($_FILES["photo"]["name"]);
        
        $sql = "INSERT INTO _PDAdmin (name, email, password, type, picture) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $password, $type, $photo);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Sorry, there was an error uploading your file."]);
    }
}
?>