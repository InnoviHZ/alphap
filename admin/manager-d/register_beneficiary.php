<?php
session_start();
header('Content-Type: application/json');
include "../../assets/include/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $full_name = $_POST['fullName'];
    $yod = $_POST['yod'];
    $full_name_b = $_POST['fullNameB'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $lga = $_POST['lga'];
    $ward = $_POST['ward'];
    $address = $_POST['address'];
    $op_number = $_POST['idNumber']; // Assuming this is the OP number
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $id_number = $_POST['idNumber'];
    $benefit_type = $_POST['benefitType'];
    $reg_by = $_SESSION['name']; // Assuming you have a session variable for the logged-in user

    // Handle file upload
    $photo = '';
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "images/";
        $photo = basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $photo;
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    }

    // Prepare SQL statement
    $sql = "INSERT INTO _PDUsers (full_name, yod, full_name_b, dob, gender, lga, ward, address, op_number, phone, email, id_number, benefit_type, photo, reg_by) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssss", $full_name, $yod, $full_name_b, $dob, $gender, $lga, $ward, $address, $op_number, $phone, $email, $id_number, $benefit_type, $photo, $reg_by);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Beneficiary registered successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error registering beneficiary: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>