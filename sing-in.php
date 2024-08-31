<?php
session_start();
include "./assets/include/config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to sanitize inputs
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve input values
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, name, password, type FROM _PDAdmin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Fetch the stored data
        $stmt->bind_result($id, $username, $storedPassword, $type);
        $stmt->fetch();

        // Compare the password directly (consider using password_hash in production)
        if ($password === $storedPassword) {
            // Store user information in session variables
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['type'] = $type; // Store admin type in session

            // Redirect to the dashboard
            header("Location: ./admin/manager-d/m-dashboard.php");
            exit();
        } else {
            // Incorrect password
            echo "Invalid email or password.";
        }
    } else {
        // No matching user found
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Orphanage Care</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="./assets/images/logo.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <style>
        

        
    </style>
</head>
<body>
    <!-- Your existing HTML content goes here -->
    <!-- ... -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <a href="index.html" class="navbar-brand">
        <img src="./assets/images/logo.png" alt="Logo" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Stories</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            </ul>
            <div class="navbar-buttons">
                <a href="./sing-in.php"><button class="btn btn-outline-success me-2">Sign In</button></a>
                <a href="./print-slip.php"><button class="btn btn-outline-success me-2">Print slip</button></a>
                <a href="./donate.php"><button class="btn btn-warning">Donate</button></a>
            </div>
        </div>
    </div>
</nav>
    <main class="flex-grow-1">
        <div class="signin-container">
            <!-- Sign-in content -->
            <div class="signin-container">
                <div class="signin-card">
                    <div class="signin-row">
                        <div class="signin-left">
                            <img src="./assets/images/logo.png" alt="Logo" class="signin-logo">
                            <h2>Welcome Back!</h2>
                            <p>Sign in to access your account and continue making a difference in children's lives.</p>
                        </div>
                        <div class="signin-right">
                            <h2 class="mb-4">Sign In</h2>
                            <form class="signin-form" method="post">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <button type="submit" class="btn btn-primary w-100">Sign In</button>
                                <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
                            </form>
                            <div class="social-signin">
                                <button class="btn btn-outline-primary"><i class="fab fa-google"></i> Google</button>
                                <button class="btn btn-outline-primary"><i class="fab fa-facebook-f"></i> Facebook</button>
                            </div>
                            <p class="mt-3 text-center">Ready to print slip? <a href="./print-slip.html">Print slip</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
    </main>
    <footer class="bg-dark text-light py-5">
        <!-- Footer content -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3>About Us</h3>
                        <p>Orphanage Help and Care is dedicated to improving the lives of orphaned children worldwide, providing love, care, and support since 2010.</p>
                    </div>
                    <div class="col-md-4">
                        <h3>Quick Links</h3>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-light">Home</a></li>
                            <li><a href="#" class="text-light">About</a></li>
                            <li><a href="#" class="text-light">Services</a></li>
                            <li><a href="#" class="text-light">Success Stories</a></li>
                            <li><a href="#" class="text-light">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Stay Connected</h3>
                        <div class="social-icons mb-3">
                            <a href="#" class="text-light me-2"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-light me-2"><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#" class="text-light me-2"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#" class="text-light"><i class="fab fa-linkedin fa-2x"></i></a>
                        </div>
                        <p>Subscribe to our newsletter:</p>
                        <form>
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Enter your email">
                                <button class="btn btn-primary" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; 2024 Orphanage Help and Care. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="text-light me-2">Privacy Policy</a>
                        <a href="#" class="text-light">Terms of Service</a>
                    </div>
                </div>
            </div>
    </footer>
</body>
</html>