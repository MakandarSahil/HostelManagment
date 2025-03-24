<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DKTE College Hostel - Your Campus Residence</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Header -->
    <header id="header">
        <div class="container header-content">
            <div class="logo">
                <span>DKTE <strong>Hostel</strong></span>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#facilities">Facilities</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="login.php" class="nav-btn">Login</a></li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="home" class="hero">
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <h1>Your Comfort, Our Priority</h1>
                <p>Experience a home away from home with modern amenities, secure environment, and a supportive community at DKTE College Hostel.</p>
                <div class="hero-buttons">
                    <a href="#rooms" class="btn btn-primary">Book Rooms</a>
                    <a href="#availability" class="btn btn-secondary">Check Availability</a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-text">Students</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-text">Safe Campus</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-text">Support</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Facilities Section -->
        <section id="facilities" class="facilities">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Amenities</span>
                    <h2>Campus Facilities</h2>
                    <p>Discover the comprehensive amenities that make our hostel exceptional.</p>
                </div>
                <div class="facilities-grid">
                    <div class="facility-card">
                        <div class="facility-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h3>High-Speed Internet</h3>
                        <p>24/7 reliable connectivity for studies and entertainment with fiber-optic network.</p>
                    </div>
                    <div class="facility-card">
                        <div class="facility-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3>Dining Hall</h3>
                        <p>Nutritious meals prepared with care and hygiene, offering diverse menu options.</p>
                    </div>
                    <div class="facility-card">
                        <div class="facility-icon">
                            <i class="fas fa-dumbbell"></i>
                        </div>
                        <h3>Fitness Center</h3>
                        <p>Modern gym equipment to keep you fit and active with professional trainers.</p>
                    </div>
                    <div class="facility-card">
                        <div class="facility-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>24/7 Security</h3>
                        <p>Comprehensive security with CCTV surveillance and trained guards to ensure your safety.</p>
                    </div>
                    <div class="facility-card">
                        <div class="facility-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3>Study Rooms</h3>
                        <p>Quiet and well-equipped study spaces for focused learning and group discussions.</p>
                    </div>
                    <div class="facility-card">
                        <div class="facility-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <h3>Laundry Service</h3>
                        <p>Convenient laundry facilities with washing machines and dryers for residents.</p>
                    </div>
                    <div class="facility-card">
                        <div class="facility-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <h3>Recreation Room</h3>
                        <p>Entertainment zone with indoor games, TV, and comfortable seating for relaxation.</p>
                    </div>
                    <div class="facility-card">
                        <div class="facility-icon">
                            <i class="fas fa-first-aid"></i>
                        </div>
                        <h3>Medical Facility</h3>
                        <p>On-campus medical assistance with regular health check-ups and emergency services.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section id="gallery" class="gallery">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Photos</span>
                    <h2>Hostel Gallery</h2>
                    <p>Take a visual tour of our hostel facilities and campus life.</p>
                </div>
                <div class="gallery-filter">
                    <button class="filter-btn active" data-filter="all">All</button>
                    <button class="filter-btn" data-filter="rooms">Rooms</button>
                    <button class="filter-btn" data-filter="dining">Dining</button>
                    <button class="filter-btn" data-filter="campus">Campus</button>
                    <button class="filter-btn" data-filter="activities">Activities</button>
                </div>
                <div class="gallery-grid">
                    <div class="gallery-item" data-category="rooms">
                        <img src="/placeholder.svg?height=300&width=400" alt="Standard Room">
                        <div class="gallery-overlay">
                            <h3>Standard Room</h3>
                            <a href="#" class="gallery-icon"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="rooms">
                        <img src="/placeholder.svg?height=300&width=400" alt="Deluxe Room">
                        <div class="gallery-overlay">
                            <h3>Deluxe Room</h3>
                            <a href="#" class="gallery-icon"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="dining">
                        <img src="/placeholder.svg?height=300&width=400" alt="Dining Hall">
                        <div class="gallery-overlay">
                            <h3>Dining Hall</h3>
                            <a href="#" class="gallery-icon"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="campus">
                        <img src="/placeholder.svg?height=300&width=400" alt="Campus View">
                        <div class="gallery-overlay">
                            <h3>Campus View</h3>
                            <a href="#" class="gallery-icon"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="activities">
                        <img src="/placeholder.svg?height=300&width=400" alt="Sports Activities">
                        <div class="gallery-overlay">
                            <h3>Sports Activities</h3>
                            <a href="#" class="gallery-icon"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="campus">
                        <img src="/placeholder.svg?height=300&width=400" alt="Study Area">
                        <div class="gallery-overlay">
                            <h3>Study Area</h3>
                            <a href="#" class="gallery-icon"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="faq">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Questions</span>
                    <h2>Frequently Asked Questions</h2>
                    <p>Find answers to common questions about our hostel facilities and policies.</p>
                </div>
                <div class="faq-container">
                    <div class="faq-item active">
                        <div class="faq-question">
                            <h3>What are the hostel timings and curfew hours?</h3>
                            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>The hostel gates close at 10:00 PM on weekdays and 11:00 PM on weekends. Students are expected to be inside the hostel premises by this time. Late entries require prior permission from the warden.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>What items should I bring when moving into the hostel?</h3>
                            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>Students should bring personal items like bedding (mattress cover, pillow, blanket), toiletries, study materials, and clothing. Basic furniture like bed, desk, chair, and wardrobe are provided by the hostel.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>How is the food service organized in the hostel?</h3>
                            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>The hostel provides three meals a day - breakfast, lunch, and dinner. Meal timings are displayed in the dining hall. Special dietary requirements can be accommodated with prior notice to the mess manager.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Is there a laundry service available?</h3>
                            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, the hostel has a laundry room equipped with washing machines and dryers. Additionally, a paid laundry service is available for students who prefer professional cleaning of their clothes.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>What security measures are in place at the hostel?</h3>
                            <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>The hostel has 24/7 security guards, CCTV surveillance, biometric entry system, and regular security patrols. Visitors are required to register at the reception and are only allowed in designated areas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta">
            <div class="container">
                <div class="cta-content">
                    <h2>Ready to Join Our Hostel Community?</h2>
                    <p>Book your room now and secure your place in DKTE's premier student accommodation.</p>
                    <div class="cta-buttons">
                        <a href="#availability" class="btn btn-primary">Check Availability</a>
                        <a href="#contact" class="btn btn-secondary">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-header">
                    <span class="section-subtitle">Get in Touch</span>
                    <h2>Contact Us</h2>
                    <p>Have questions? Reach out to us for more information.</p>
                </div>
                <div class="contact-container">
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h3>Location</h3>
                                <p>DKTE College Campus, Rajwada, Ichalkaranji, Maharashtra 416115</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <div>
                                <h3>Phone</h3>
                                <p>+91 1234567890</p>
                                <p>+91 9876543210</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h3>Email</h3>
                                <p>hostel@dkte.ac.in</p>
                                <p>admissions@dkte.ac.in</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h3>Office Hours</h3>
                                <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                                <p>Saturday: 9:00 AM - 1:00 PM</p>
                            </div>
                        </div>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="contact-form">
                        <form>
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" placeholder="Your Phone">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" placeholder="Your Message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section
        <section class="map">
            <div class="map-container">
                <img src="/placeholder.svg?height=400&width=1200" alt="DKTE Hostel Location Map">
            </div>
        </section> -->
    </main>

    <footer>
      
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; 2024 DKTE College Hostel. All Rights Reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- JavaScript -->
    <script>
        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            preloader.classList.add('preloader-hide');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 1000);
        });

        // Mobile Menu Toggle
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');
        
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        // Sticky Header
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        });

        // Active Navigation Link
        const sections = document.querySelectorAll('section[id]');
        
        function scrollActive() {
            const scrollY = window.pageYOffset;
            
            sections.forEach(current => {
                const sectionHeight = current.offsetHeight;
                const sectionTop = current.offsetTop - 100;
                const sectionId = current.getAttribute('id');
                
                if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                    document.querySelector('.nav-menu a[href*=' + sectionId + ']').classList.add('active');
                } else {
                    document.querySelector('.nav-menu a[href*=' + sectionId + ']').classList.remove('active');
                }
            });
        }
        
        window.addEventListener('scroll', scrollActive);

        // FAQ Accordion
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            
            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                
                // Close all FAQ items
                faqItems.forEach(faqItem => {
                    faqItem.classList.remove('active');
                });
                
                // Open clicked item if it wasn't active
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });

        // Gallery Filter
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                filterBtns.forEach(filterBtn => {
                    filterBtn.classList.remove('active');
                });
                
                // Add active class to clicked button
                btn.classList.add('active');
                
                const filter = btn.getAttribute('data-filter');
                
                galleryItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Testimonial Slider
        let currentSlide = 0;
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        const dots = document.querySelectorAll('.dot');
        const prevBtn = document.querySelector('.testimonial-prev');
        const nextBtn = document.querySelector('.testimonial-next');
        
        function showSlide(index) {
            // Hide all slides
            testimonialCards.forEach(card => {
                card.style.display = 'none';
            });
            
            // Remove active class from all dots
            dots.forEach(dot => {
                dot.classList.remove('active');
            });
            
            // Show current slide and activate corresponding dot
            testimonialCards[index].style.display = 'block';
            dots[index].classList.add('active');
        }
        
        // Initialize slider
        showSlide(currentSlide);
        
        // Previous button click
        prevBtn.addEventListener('click', () => {
            currentSlide--;
            if (currentSlide < 0) {
                currentSlide = testimonialCards.length - 1;
            }
            showSlide(currentSlide);
        });
        
        // Next button click
        nextBtn.addEventListener('click', () => {
            currentSlide++;
            if (currentSlide >= testimonialCards.length) {
                currentSlide = 0;
            }
            showSlide(currentSlide);
        });
        
        // Dot click
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        // Back to Top Button
        const backToTopBtn = document.querySelector('.back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        backToTopBtn.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
    </script>
</body>
</html>