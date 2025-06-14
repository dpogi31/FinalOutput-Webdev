<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location:CSLandingPage.php");
  exit();
}

$userEmail = $_SESSION['user_email'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chrono Sync | Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600&family=Raleway:wght@400;500;600&family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="CS.css" />
</head>

<body class="body1">
  <header class="navbar">
    <div class="logo">
      <img src="assets/images/logo1.png" alt="logo">
    </div>
    <nav class="navcontainer">
      <ul class="navlinks">
        <li><a href="CSHomePage.php">Home</a></li>
        <li><a href="CSProducts.php">Products</a></li>
        <li><a href="CSCart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
        <li><a href="#" id="supportBtn">Support</a></li>
        <li><a href="#" id="contactBtn">Contact</a></li>
      </ul>

      <form id="logoutForm" method="POST" action="logout.php" style="display:inline;">
        <button type="button" class="logout-btn" id="logoutBtn">Logout</button>

        <div id="logoutModal" class="modal-overlay" style="display:none;">
          <div class="modal-box">
            <h2>Confirm Logout</h2>
            <p>Are you sure you want to log out?</p>
            <div class="modal-actions">
              <button type="submit" id="confirmLogout" class="modal-btn confirm">Yes</button>
              <button type="button" id="cancelLogout" class="modal-btn cancel">No</button>
            </div>
          </div>
        </div>
      </form>

    </nav>

  </header>


  <main class="home-page">
    <section class="hero">
      <div class="hero-text">
        <h1>Welcome to <span>Chrono Sync</span></h1>
        <p>Timepieces redefined - explore innovative design and premium craftsmanship with every tick.</p>
        <div class="hero-buttons">
          <a href="CSProducts.php" class="btn">Shop Now</a>
          <a href="#" class="btn secondary" id="learnMoreBtn">Learn More</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="assets/images/CW.png" alt="Chrono Watch" />
      </div>
    </section>

    <section class="features">
      <h2>Featured Collections</h2>
      <div class="feature-cards">
        <div class="card">
          <img src="assets/images/FP1.png" alt="Watch 1">
          <h3>Modern Classic</h3>
          <p>Timeless design with cutting-edge technology.</p>
        </div>
        <div class="card">
          <img src="assets/images/FP2.jpg" alt="Watch 2">
          <h3>Urban Sync</h3>
          <p>Designed for the fast-paced modern lifestyle.</p>
        </div>
        <div class="card">
          <img src="assets/images/FP3.webp" alt="Watch 3">
          <h3>Elegant Tech</h3>
          <p>Luxury meets smart innovation.</p>
        </div>
      </div>
    </section>
  </main>
  <div id="supportModal" class="modal-overlay-support">
    <div class="modal-box-support">
      <span class="close-btn-support" id="closeSupportModal">&times;</span>
      <h2>Need Help?</h2>
      <p>If you have any questions or issues, feel free to reach out to our support team!</p>
      <form id="supportForm">
        <input type="text" placeholder="Your Name" required />
        <input type="email" placeholder="Your Email" required />
        <textarea placeholder="How can we help you?" required></textarea>
        <button type="submit" class="modal-btn-support confirm">Send</button>
        <p>© 2025 ChronoSync. All rights reserved.</p>
      </form>
    </div>
  </div>

  <div class="modal-overlay-contact" id="contactModal">
    <div class="modal-box-contact">
      <button id="closeContactModal">&times;</button>
      <h2>Contact Us</h2>
      <p>Have questions or feedback? We'd love to hear from you.</p>
      <form id="contactForm">
        <input type="text" placeholder="Your Name" required />
        <input type="email" placeholder="Your Email" required />
        <textarea placeholder="Your Message" required></textarea>
        <button type="submit" class="modal-btn-contact">Send Message</button>
        <p>© 2025 ChronoSync. All rights reserved.</p>
      </form>
    </div>
  </div>

</body>

<div class="modal" id="learnMoreModal">
  <div class="modal-content">
    <span class="close-btn" id="closeModal">&times;</span>
    <h2>About <span class="brand1">Chrono Sync</span></h2>
    <p>
      Chrono Sync is a fusion of precision and style, delivering smart timepieces crafted for the future.
      Our mission is to blend classic aesthetics with modern technology, creating watches that do more than just tell
      time.
    </p>
    <p>
      Whether you're an urban explorer, a tech enthusiast, or a minimalist trendsetter, Chrono Sync offers collections
      that match your lifestyle.
    </p><br>
    <p>© 2025 ChronoSync. All rights reserved.</p>
  </div>
</div>

<footer class="footer-landing">
  <div class="footer-content">
    <h2>Chrono Sync</h2>
    <p>Stay in sync with your health, your style, and your time. Only at Chrono Sync.</p>
    <div class="footer-icons">
      <a href="https://www.facebook.com/" aria-label="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
      <a href="https://www.instagram.com/" aria-label="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.tiktok.com/" aria-label="Tiktok" target="_blank"><i class="fab fa-tiktok"></i></a>
      <a href="https://www.youtube.com/" aria-label="Youtube" target="_blank"><i class="fab fa-youtube"></i></a>
      <a href="https://www.linkedin.com/" aria-label="Linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>

    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 ChronoSync. All rights reserved.</p>
  </div>
</footer>



<script src="CS.js"></script>

</html>