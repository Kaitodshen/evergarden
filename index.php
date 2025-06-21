<?php
require_once 'functions.php';

$products = products();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EVERGARDEN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Top Bar Start -->
    <div class="top-bar d-none d-md-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="top-bar-right">
                        <div class="social">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Bar End -->

    <!-- Nav Bar Start -->
    <div class="navbar navbar-expand-lg bg-light navbar-dark">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">
                <img src="img/evergarden_logo.png" />
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="login.php" class="nav-item nav-link bg-dark">Login</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav Bar End -->

    <!-- Hero Start -->
    <div class="hero">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-6">
                    <div class="hero-text">
                        <h1>
                            &#34;Every flower is a soul <br />blossoming in nature.&#34;&nbsp;&nbsp; <br />- Gerard de
                            Nerval
                        </h1>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="hero-image mt-5x">
                        <img src="img/evergarden_square.png" alt="Hero Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="about wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="about-img">
                        <img src="img/flower-1.png" alt="Image">
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="section-header text-left">
                        <p>About Evergarden</p>
                        <h2>Bloom With Grace</h2>
                    </div>
                    <div class="about-text">
                        <p>
                            Evergarden is a sanctuary where flowers don’t just grow — they tell stories. We believe
                            every petal holds a whisper of nature’s soul, blooming to bring beauty and meaning into your
                            life.
                        </p>
                        <p>
                            With handpicked collections and artful arrangements, we bring the magic of nature closer to
                            your heart. Discover serenity, warmth, and wonder in every bloom.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="service">
        <div class="container">
            <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                <p>What We Offer</p>
                <h2>Experience Nature's Elegance</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.0s">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fa fa-leaf"></i>
                        </div>
                        <h3>Floral Arrangements</h3>
                        <p>
                            Elegant and custom floral designs for every occasion, crafted with love and care.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item active">
                        <div class="service-icon">
                            <i class="fa fa-tree"></i>
                        </div>
                        <h3>Garden Styling</h3>
                        <p>
                            Bring your garden to life with our creative touch and natural harmony designs.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fa fa-sun"></i>
                        </div>
                        <h3>Botanical Workshops</h3>
                        <p>
                            Learn the art of floristry and connect with nature through hands-on experiences.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fa fa-heart"></i>
                        </div>
                        <h3>Event Floral Design</h3>
                        <p>
                            From weddings to intimate moments, our flowers set the perfect mood and emotion.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fa fa-water"></i>
                        </div>
                        <h3>Plant Care Tips</h3>
                        <p>
                            We guide you to nurture your plants so they stay vibrant, healthy, and happy.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1s">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fa fa-seedling"></i>
                        </div>
                        <h3>Sustainable Living</h3>
                        <p>
                            Embrace eco-friendly lifestyles with our green solutions and thoughtful products.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Class Start -->
    <div class="class">
        <div class="container">
            <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                <p>Our Product</p>
                <h2>Explore Our Product</h2>
            </div>
            <div class="row class-container">
                <?php foreach ($products as $product) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 class-item filter-1 wow fadeInUp" data-wow-delay="0.0s">
                        <div class="class-wrap">
                            <div class="class-img">
                                <img src="uploads/<?= $product['image'] ?>" alt="Image">
                            </div>
                            <div class="class-text">
                                <h2><?= $product['name'] ?></h2>
                                <div class="class-meta">
                                    <p><i class="fas fa-tag"></i> Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Class End -->

    <!-- Price Start -->
    <div class="price">
        <div class="container">
            <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                <p>Our Services</p>
                <h2>Floral Pricing Packages</h2>
            </div>
            <div class="row">
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.0s">
                    <div class="price-item">
                        <div class="price-header">
                            <div class="price-title">
                                <h2>Single Bouquet</h2>
                            </div>
                            <div class="price-prices">
                                <h2><small>Rp</small>150.000<span> / order</span></h2>
                            </div>
                        </div>
                        <div class="price-body">
                            <div class="price-description">
                                <ul>
                                    <li>Custom Flower Selection</li>
                                    <li>Hand-tied Bouquet</li>
                                    <li>Personalized Message</li>
                                    <li>Same Day Delivery</li>
                                </ul>
                            </div>
                        </div>
                        <div class="price-footer">
                            <div class="price-action">
                                <a class="btn" href="#">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="price-item featured-item">
                        <div class="price-header">
                            <div class="price-status">
                                <span>Most Loved</span>
                            </div>
                            <div class="price-title">
                                <h2>Monthly Decor</h2>
                            </div>
                            <div class="price-prices">
                                <h2><small>Rp</small>500.000<span> / month</span></h2>
                            </div>
                        </div>
                        <div class="price-body">
                            <div class="price-description">
                                <ul>
                                    <li>Fresh Weekly Arrangements</li>
                                    <li>Vase Included</li>
                                    <li>Free Delivery</li>
                                    <li>Priority Support</li>
                                </ul>
                            </div>
                        </div>
                        <div class="price-footer">
                            <div class="price-action">
                                <a class="btn" href="#">Subscribe Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="price-item">
                        <div class="price-header">
                            <div class="price-title">
                                <h2>Workshop Access</h2>
                            </div>
                            <div class="price-prices">
                                <h2><small>Rp</small>250.000<span> / session</span></h2>
                            </div>
                        </div>
                        <div class="price-body">
                            <div class="price-description">
                                <ul>
                                    <li>Live Floral Workshop</li>
                                    <li>All Materials Included</li>
                                    <li>Certificate Provided</li>
                                    <li>Refreshments Included</li>
                                </ul>
                            </div>
                        </div>
                        <div class="price-footer">
                            <div class="price-action">
                                <a class="btn" href="#">Join Workshop</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Price End -->

    <!-- Footer Start -->
    <div class="footer wow fadeIn" data-wow-delay="0.3s">
        <div class="container-fluid">
            <div class="container">
                <div class="footer-info text-center">
                    <a href="index.php" class="footer-logo">
                        <img src="img/evergarden_logo.png" alt="Evergarden Logo" style="height: 60px;">
                    </a>
                    <div class="footer-social mt-3">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <div class="container copyright mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <p>&copy; 2025 <strong>EVERGARDEN</strong>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>