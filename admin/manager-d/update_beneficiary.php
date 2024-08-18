<?php
include "../../assets/include/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // For this example, we'll just update the timestamp
    $query = "UPDATE _PDUsers SET tstamp = CURRENT_TIMESTAMP WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "Beneficiary updated successfully";
    } else {
        echo "Error updating beneficiary: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<?php
session_start();
include "../../assets/include/config.php";

if(isset($_SESSION['admin_id'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $sql = "UPDATE _PDAdmin SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $email, $_SESSION['admin_id']);
    $stmt->execute();

    if($_FILES['profilePicture']['name']) {
        $target_dir = "uploads/";
        $file_extension = pathinfo($_FILES["profilePicture"]["name"], PATHINFO_EXTENSION);
        $file_name = "admin_" . $_SESSION['admin_id'] . "." . $file_extension;
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file)) {
            $sql = "UPDATE _PDAdmin SET picture = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $file_name, $_SESSION['admin_id']);
            $stmt->execute();
        }
    }

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Not logged in"]);
}

$conn->close();
?>