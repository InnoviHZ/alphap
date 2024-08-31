<?php
// Start the session to access the logged-in user's information
session_start();

// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "alpha";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $type = $conn->real_escape_string($_POST['type']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $lga = $conn->real_escape_string($_POST['lga']);
    $reg_by = $conn->real_escape_string($_SESSION['user_name']); // Assuming the logged-in user's name is stored in the session

    // Handle file upload
    $picture = "";
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        if($check !== false) {
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                $picture = basename($_FILES["picture"]["name"]);
            }
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO _PDAdmin (name, email, password, type, picture, phone, address, reg_by, lga) 
            VALUES ('$name', '$email', '$password', '$type', '$picture', '$phone', '$address', '$reg_by', '$lga')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>