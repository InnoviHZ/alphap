<?php
    include "./assets/include/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Keep the existing head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orphanage Care - Donate</title>
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
    <!-- Keep the existing navbar -->
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
        <!-- ... -->
    </nav>

    <!-- Replace the main content with the donation form -->
    <div class="container-fluid body">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-donation-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <h1 class="h3 text-gray-900">Make a Donation</h1>
                                        <p class="lead">Choose your preferred donation method below</p>
                                    </div>

                                    <!-- Bank Details Section -->
                                    <div class="donation-option mb-3">
                                        <button class="btn btn-outline-primary w-100 text-left d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#bankDetails" aria-expanded="false" aria-controls="bankDetails">
                                            <span><i class="fas fa-university me-2"></i> Bank Transfer</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="collapse mt-3" id="bankDetails">
                                            <div class="card card-body">
                                                <h5 class="card-title">Bank Account Details</h5>
                                                <p><strong>Account Name:</strong> OrphaCare Foundation</p>
                                                <p><strong>Account Number:</strong> 1234567890 <i class="fas fa-copy text-primary copy-icon" onclick="copyToClipboard('1234567890')"></i></p>
                                                <p><strong>Bank Name:</strong> Example Bank</p>
                                                <p><strong>SWIFT Code:</strong> EXAMPLEBANKXXX</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Options Section -->
                                    <div class="donation-option mb-3">
                                        <button class="btn btn-outline-success w-100 text-left d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#paymentOptions" aria-expanded="false" aria-controls="paymentOptions">
                                            <span><i class="fas fa-credit-card me-2"></i> Online Payment</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                        <div class="collapse mt-3" id="paymentOptions">
                                            <div class="card card-body">
                                                <h5 class="card-title">Choose a Payment Method</h5>
                                                <a href="#" class="btn btn-outline-primary btn-user payment-btn w-100 mb-2">
                                                    <i class="fas fa-money-bill-wave fa-fw"></i> Pay with Monify
                                                </a>
                                                <a href="#" class="btn btn-outline-success btn-user payment-btn w-100 mb-2">
                                                    <i class="fas fa-credit-card fa-fw"></i> Pay with Remita
                                                </a>
                                                <a href="#" class="btn btn-outline-info btn-user payment-btn w-100 mb-2">
                                                    <i class="fas fa-wallet fa-fw"></i> Pay with Paystack
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- QR Pay Section (Always Visible) -->
                                    <div class="donation-option mb-3">
                                        <div class="card card-body text-center">
                                            <h5 class="card-title"><i class="fas fa-qrcode me-2"></i> QR Code Payment</h5>
                                            <p>Use your mobile banking app to scan and pay</p>
                                            <div class="qr-code">
                                                <img src="./assets/images/donate.png" alt="QR Code for payment" class="img-fluid" style="max-width: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Keep the existing footer -->
    <footer class="bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>About Us</h3>
                    <p>Orphanage Help and Care is dedicated to improving the lives of orphaned children worldwide, providing love, care, and support since 2010.</p>
                </div>
                <div class="col-md-4">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#stories">Success Stories</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Stay Connected</h3>
                    <div class="social-icons mb-3">
                        <a href="#" class="me-2"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#"><i class="fab fa-linkedin fa-2x"></i></a>
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

    <script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Copied to clipboard: ' + text);
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    // Add animation to chevron icons
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
        button.addEventListener('click', function() {
            this.querySelector('.fa-chevron-down').classList.toggle('fa-rotate-180');
        });
    });
    </script>
</body>
</html>