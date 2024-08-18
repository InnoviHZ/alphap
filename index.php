<?php
    include "./assets/include/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orphanage Care</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <link rel="icon" href="./assets/images/logo.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <style>
        
    </style>
</head>
<body>
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
    <header class="hero" id="home">
        <!-- Swiper Slider Container -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://thumbs.dreamstime.com/b/volunteers-visit-orphanage-give-out-gifts-pay-attention-help-children-people-engaged-charitable-affairs-95153288.jpg?w=768" alt="Volunteers visiting an orphanage">
                </div>
                <div class="swiper-slide">
                    <img src="https://thumbs.dreamstime.com/b/volunteers-visit-orphanage-happy-orphans-man-woman-donations-presents-children-running-hugging-male-female-characters-196198742.jpg?w=768" alt="Happy orphans receiving gifts">
                </div>
                <div class="swiper-slide">
                    <img src="https://thumbs.dreamstime.com/b/people-donate-concept-men-woman-cardboard-boxes-send-clothes-toys-to-orphanage-generosity-kindness-charitable-foundation-324566680.jpg?w=992" alt="People donating clothes and toys to an orphanage">
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        
        <!-- Hero Section -->
        <section class="hero">
            <!-- Hero content -->
        </section>
                <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination if needed -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation if needed -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    
        <!-- Existing Hero Content -->
        <div class="container hero-content">
            <h1>Help Us Make a Difference</h1>
            <p>Together, we can provide care and support for orphaned children.</p>
            <a href="./donate.php" class="cta-btn"><i class="fas fa-hands-helping"></i> Donate Now</a>
        </div>
        
        <!-- Wave Animation -->
        <div class="wave-animation">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(69,148,93,0.7)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(69,148,93,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(69,148,93,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#45945d" />
                </g>
            </svg>
        </div>
    </header>
    <section id="about" class="section">
        <div class="container">
            <h2>About Us</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>Orphanage Help and Care is dedicated to improving the lives of orphaned children around the world. Our mission is to provide love, care, and support to ensure every child has the opportunity to grow, learn, and thrive in a nurturing environment.</p>
                    <p>Founded in 2010, we have helped over 5,000 children find loving homes and access quality education. Our team of passionate individuals works tirelessly to create a better future for those in need.</p>
                </div>
                <div class="about-image">
                    <img src="https://img.freepik.com/free-vector/meet-our-team-concept-landing-page_52683-12622.jpg?ga=GA1.1.1275302475.1722302999&semt=ais_hybrid" alt="Children at our orphanage">
                </div>
            </div>
        </div>
    </section>
    <section id="services" class="section">
        <div class="container">
            <h2>Our Services</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card">
                        <i class="fas fa-home"></i>
                        <h3>Safe Housing</h3>
                        <p>We provide safe and comfortable living spaces for orphaned children, ensuring a nurturing environment for their growth.</p>
                    </div>
                </div>
                <div class="col-md-4 my-2">
                    <div class="service-card">
                        <i class="fas fa-book"></i>
                        <h3>Education</h3>
                        <p>Access to quality education and learning resources, including tutoring and skill development programs.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <i class="fas fa-heart"></i>
                        <h3>Emotional Support</h3>
                        <p>Professional counseling and emotional care to ensure the mental well-being of our children.</p>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-4">
                    <div class="service-card">
                        <i class="fas fa-utensils"></i>
                        <h3>Nutrition</h3>
                        <p>Healthy and balanced meals to support children's growth and development, with dietary guidance.</p>
                    </div>
                </div>
                <div class="col-md-4 my-2">
                    <div class="service-card">
                        <i class="fas fa-hands-helping"></i>
                        <h3>Adoption Services</h3>
                        <p>Assistance in finding loving families for our children through our comprehensive adoption program.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <i class="fas fa-graduation-cap"></i>
                        <h3>Career Guidance</h3>
                        <p>Vocational training and career counseling to prepare older children for independent living.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="stories" class="section">
        <div class="container">
            <h2>Success Stories</h2>
            <div class="stories-slider">
                <div class="story-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmOYGO3i5O4ltS-Sa1TCggQTaIZJLBBZmtow&s" alt="Sarah">
                    <h3>Sarah's Journey</h3>
                    <p>"Thanks to Orphanage Help and Care, I was able to pursue my dreams and become a doctor. Their support changed my life."</p>
                </div>
                <!-- Add more story cards as needed -->
            </div>
        </div>
    </section>
    <section id="contact" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Contact Us</h2>
                    <form class="contact-form">
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Message</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        
                    </div>
                    <div class="map">
                        <!-- Add a map here, e.g., Google Maps embed -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62678.90766133579!2d10.167495706249999!3d11.675422600000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x11051df731f6ac69%3A0xde1260fcb1f5f933!2sAzare%2C%20Nigeria!5e0!3m2!1sen!2sus!4v1658049474216!5m2!1sen!2sus" width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                    var swiper = new Swiper('.swiper-container', {
                      loop: true,
                      autoplay: {
                        delay: 5000, // Slide delay in milliseconds
                        disableOnInteraction: false, // Allow autoplay to continue even after user interactions
                      },
                      pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                      },
                      navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                      },
                    });
                  </script>    
</body>
</html>
