<?php
$msg = '';
$msg_type = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // subject  optional, only name+email+message required
    if($name && $email && $message) {
        $to      = 'hello@velvetvine.in';
        $headers  = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $body    = "Name: $name\n\nMessage:\n$message";
        
        // file_put_contents('logs/contacts.txt', date('Y-m-d H:i') . " | $name | $email\n", FILE_APPEND);
        mail($to, $subject ?: 'New message from website', $body, $headers);

        $msg_type = 'success';
        $msg = "Thanks! We'll get back to you within a day or two.";
    } else {
        $msg_type = 'error';
        $msg = 'Please fill in your name, email and message.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VelvetVine | Premium Clothing</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    
    <header>
        <div class="header-inner">
            <div class="logo">VELVET<span>VINE</span></div>
            <nav class="nav-links">
                <a href="#banner">Home</a>
                <a href="#services">Collections</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </nav>
            <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
        </div>
        <div class="mobile-menu" id="mobileMenu">
            <a href="#banner" onclick="toggleMenu()">Home</a>
            <a href="#services" onclick="toggleMenu()">Collections</a>
            <a href="#about" onclick="toggleMenu()">About</a>
            <a href="#contact" onclick="toggleMenu()">Contact</a>
        </div>
    </header>

    
    <section id="banner">
        <div class="banner-img">
            <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=1600" alt="Fashion Banner">
            <div class="banner-overlay"></div>
        </div>
        <div class="banner-content">
            <p class="banner-tag">Summer 2026</p>
            <h1>Style That<br><span>Speaks For You</span></h1>
            <p class="banner-sub">Fresh fits for every mood.</p>
            <div class="banner-btns">
                <a href="#services" class="btn btn-white">Shop Now</a>
                <a href="#about" class="btn btn-outline">Our Story</a>
            </div>
        </div>
    </section>

    
    <div class="marquee-strip">
        <div class="marquee-inner">
            <span>NEW ARRIVALS &nbsp;★&nbsp; FREE SHIPPING OVER ₹999 &nbsp;★&nbsp; WOMEN'S WEAR &nbsp;★&nbsp; MEN'S WEAR &nbsp;★&nbsp; FESTIVE SPECIAL &nbsp;★&nbsp; KID'S WEAR &nbsp;★&nbsp; NEW ARRIVALS &nbsp;★&nbsp; FREE SHIPPING OVER ₹999 &nbsp;★&nbsp; WOMEN'S WEAR &nbsp;★&nbsp; MEN'S WEAR &nbsp;★&nbsp;</span>
        </div>
    </div>

    <!--collectioss-->
    <section id="services">
        <div class="section-inner">
            <div class="section-head">
                <h2>Our Collections</h2>
                <p>Something for everyone, every season</p>
            </div>
            <div class="collections-grid">
                <div class="collection-card tall">
                    <img src="https://images.unsplash.com/photo-1581044777550-4cfa60707c03?w=780&q=72" alt="Women's Wear">
                    <div class="collection-overlay">
                        <h3>Women's Wear</h3>
                        <a href="#" class="btn-sm">Shop Now</a>
                    </div>
                </div>
                <div class="collection-card">
                    <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?w=800&q=75" alt="Men's Wear">
                    <div class="collection-overlay">
                        <h3>Men's Wear</h3>
                        <a href="#" class="btn-sm">Shop Now</a>
                    </div>
                </div>
                <div class="collection-card">
                    <img src="https://images.unsplash.com/photo-1519238263530-99bdd11df2ea?w=820&q=75" alt="Kids Wear">
                    <div class="collection-overlay">
                        <h3>Kids' Wear</h3>
                        <a href="#" class="btn-sm">Shop Now</a>
                    </div>
                </div>
                <div class="collection-card wide">
                    <img src="https://images.unsplash.com/photo-1756483510837-83203eba47e9?w=1200&q=78" alt="Festive">
                    <div class="collection-overlay">
                        <h3>Festive Special</h3>
                        <a href="#" class="btn-sm">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--trending /featured-->
    <section id="featured">
        <div class="section-inner">
            <div class="section-head">
                <h2>Trending Now</h2>
                <p>Our most loved pieces this season</p>
            </div>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=600" alt="Product 1">
                        <span class="product-tag">New</span>
                    </div>
                    <div class="product-info">
                        <h4>Summer Floral Dress</h4>
                        <p>Women's Wear</p>
                        <span>₹1,299</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=590" alt="Product 2">
                        <span class="product-tag">Hot</span>
                    </div>
                    <div class="product-info">
                        <h4>Classic White Tee</h4>
                        <p>Men's Wear</p>
                        <span>₹699</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1762777777819-4d9aa5529368?w=600&q=78" alt="Product 3">
                        <span class="product-tag">Sale</span>
                    </div>
                    <div class="product-info">
                        <h4>Ethnic Kurti Set</h4>
                        <p>Festive Special</p>
                        <span>₹1,899</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=600&q=76" alt="Product 4">
                    </div>
                    <div class="product-info">
                        <h4>Denim Jacket</h4>
                        <p>Men's Wear</p>
                        <span>₹2,499</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--about us -->
    <section id="about">
        <div class="about-inner">
            <div class="about-img-col">
                <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=900&q=80" alt="About Us">
            </div>
            <div class="about-text-col">
                <p class="about-tag">Our Story</p>
                <h2>Fashion With a Purpose</h2>
                <p>VelvetVine started in 2015 out of a small warehouse in Delhi. The idea was simple - good clothing shouldn't cost a fortune. We tie up directly with weavers and small manufacturers across India so there's no middleman markup.</p>
                <p>Every piece goes through a quality check before it ships. We're picky about that part.</p>
                <div class="about-stats">
                    <div class="stat">
                        <h3>11</h3>
                        <span>Years</span>
                    </div>
                    <div class="stat">
                        <h3>47k+</h3>
                        <span>Customers</span>
                    </div>
                    <div class="stat">
                        <h3>183+</h3>
                        <span>Styles</span>
                    </div>
                </div>
                <a href="#contact" class="btn btn-dark">Get In Touch</a>
            </div>
        </div>
    </section>

    
    <section id="contact">
        <div class="section-inner">
            <div class="section-head">
                <h2>Contact Us</h2>
                <p>We'd love to hear from you</p>
            </div>
            <div class="contact-wrapper">
                <div class="contact-info">
                    <div class="info-item">
                        <div class="info-icon"></div>
                        <div>
                            <h4>Visit Us</h4>
                            <p>42, Fashion Street, Connaught Place<br>New Delhi - 110001</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"></div>
                        <div>
                            <h4>Call Us</h4>
                            <p>+91 99999 99999</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"></div>
                        <div>
                            <h4>Email Us</h4>
                            <p>hello@velvetvine.in</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"></div>
                        <div>
                            <h4>Store Hours</h4>
                            <p>Mon-Sat: 10am - 8pm</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="index.php#contact" class="contact-form">
                    <?php if($msg): ?>
                        <div class="alert <?= $msg_type == 'success' ? 'alert-success' : 'alert-error' ?>">
                            <?= $msg ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name *"
                                value="<?= isset($name) ? $name : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email *"
                                value="<?= isset($email) ? $email : '' ?>" required>
                        </div>
                    </div>
                    <input type="text" name="subject" placeholder="Subject (optional)"
                        value="<?= isset($subject) ? $subject : '' ?>">
                    <textarea name="message" placeholder="Your Message *" required><?= isset($message) ? $message : '' ?></textarea>
                    <button type="submit" class="btn btn-dark">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    
    <footer>
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">VELVET<span>VINE</span></div>
                <p>Quality clothing for every occasion.<br>Made in India, loved everywhere.</p>
                <div class="socials">
                    <a href="#">IG</a>
                    <a href="#">FB</a>
                    <a href="#">PIN</a>
                </div>
            </div>
            <div class="footer-links">
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <a href="#banner">Home</a>
                    <a href="#services">Collections</a>
                    <a href="#about">About</a>
                    <a href="#contact">Contact</a>
                </div>
                <div class="footer-col">
                    <h4>Collections</h4>
                    <a href="#">Women's Wear</a>
                    <a href="#">Men's Wear</a>
                    <a href="#">Kids' Wear</a>
                    <a href="#">Festive Special</a>
                </div>
                <div class="footer-col">
                    <h4>Help</h4>
                    <a href="#">Size Guide</a>
                    <a href="#">Shipping Info</a>
                    <a href="#">Returns</a>
                    <a href="#">FAQs</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 VelvetVine. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('mobileMenu');
            menu.classList.toggle('open');
        }

        // smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                var id = this.getAttribute('href').split('#')[1];
                if(!id) return;
                var el = document.getElementById(id);
                if(el) {
                    e.preventDefault();
                    el.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>

</body>
</html>
