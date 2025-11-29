<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BATRASCO - Batangas Transportation Corporation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            /* New Color Palette */
            --blue: #293B8B; 
            --orange: #F2B480; 
            --red: #D74B2A; 
            --navy: #293855; 
            --green: #667A56; 
            --light: #f8f9fa; 
            --white: #ffffff;
            --pending: #F2B480; 
            --success: #667A56;
            --inactive-color: #e3f2fd; 

            /* Redefined standard colors based on new palette */
            --primary-color: var(--blue);
            --accent-color: var(--red);
            --secondary-accent-color: var(--orange);
            --dark-background: var(--navy);
            --light-background: var(--light);
            --card-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.08); 
            --dark-text: #343a40;
            --section-padding: 5rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-background); 
            min-height: 100vh;
            /* Inalis ang padding-top: 5rem; */
        }

        /* --- Global Component Styling --- */
        .section-heading {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 3rem; 
        }
        
        .card {
            border: 1px solid var(--inactive-color);
            border-radius: 0.75rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        /* --- Hero Section --- */
        .hero {
            background-image: url('map-bg.jpg'); 
            background-size: cover; 
            background-position: center center;
            background-repeat: no-repeat;
            padding: 7rem;
            position: relative;
            z-index: 1; 
            background-color: var(--dark-background); 
            background-blend-mode: multiply; 
        }

        .hero-text h1 {
            font-size: 2.6rem; 
            font-weight: 900;
            color: var(--white); 
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .hero-text p {
            font-size: 1.1rem;
            color: var(--white); 
            margin-bottom: 2rem;
        }

        .hero-badge {
            background-color: var(--accent-color); 
            border: 2px solid var(--white); 
            color: var(--white); 
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        .hero-badge i {
            color: var(--white);
        }

        /* --- Vision Metrics Block Styling --- */
        .metrics-block .metric-item {
            background-color: var(--inactive-color);
            padding: 1.5rem 0.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 0.5rem rgba(0, 0, 0, 0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: all 0.3s ease;
        }

        .metrics-block .metric-item:hover {
            background-color: var(--light);
            box-shadow: 0 0.3rem 0.75rem rgba(0, 0, 0, 0.1);
        }

        .metrics-block .metric-item i {
            color: var(--accent-color);
            font-size: 2rem;
            margin-bottom: 0.25rem;
        }

        .metrics-block .metric-item h3 {
            font-weight: 800;
            color: var(--primary-color);
            font-size: 1.8rem;
            line-height: 1.2;
            margin-bottom: 0;
        }

        .metrics-block .metric-item p {
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 600;
            opacity: 0.9;
            color: var(--dark-text);
            margin-bottom: 0;
        }

        /* --- Fleet Showcase Cards --- */
        .showcase-card img {
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid var(--inactive-color);
        }

        /* --- Feature Cards (Rectangle Icon Background) */
        .feature-card { 
            height: 100%;
        }
        
        .feature-card .card-body {
            display: flex;
            flex-direction: column;
            padding: 1.75rem;
            align-items: center; /* Center items in card */
        }

        .feature-card i {
            color: var(--white);
            border-radius: 0.75rem;
            background-color: var(--primary-color);
            padding: 1rem;
            width: 90%; 
            height: 4rem; /* Rectangle height is slightly shorter than width */
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 2.5rem !important;
            line-height: 1;
        }
        
        /* Contact Section  */
        .contact-item-new {
            background-color: rgba(255, 255, 255, 0.05); /* Subtle background for contrast */
            padding: 1.5rem;
            border-radius: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            height: 100%; /* For equal height effect */
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            transition: background-color 0.3s;
        }

        .contact-item-new:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .contact-item-new i {
            font-size: 2rem;
            color: var(--orange);
            margin-bottom: 0.75rem;
        }

        .contact-item-new h5 {
            font-size: 1.1rem; 
            margin-bottom: 0.25rem !important;
        }

        .contact-item-new p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        @media (max-width: 991px) {
            body { padding-top: 4.5rem; }
            .hero { 
                padding-top: 4rem; 
                margin-top: 0; 
            }
        }
    </style>
</head>
<body>
   <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--dark-background);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#" style="margin-left: -15px;">
                <img src="batrasco-logo.png" alt="BATRASCO Logo" class="me-2" style="width: 40px; height: 40px; border-radius: 50px">
                <div>
                    <div class="fw-bold fs-5" style="margin-bottom: -12px;">BATRASCO</div>
                    <small style="color: var(--secondary-accent-color); font-weight: 500; font-size: 0.75rem;">Batangas Transportation Corporation</small>
                </div>
            </a>
            <a href="/batrasco.co/app/views/passenger/login.php" class="btn fw-bold px-3 py-1 ms-auto" style="background-color: var(--accent-color); color: var(--white); border-radius: 0.5rem;">
                <i class="fas fa-sign-in-alt me-2"></i>Login
            </a>
        </div>
    </nav>

    <section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-text">
                <h1 class="display-4">Modernizing Batangas Transport</h1>
                <p class="lead">Leading the way in sustainable, safe, and comfortable public transportation across Batangas with our fleet of state-of-the-art modern jeepneys</p>
                <div class="hero-badge">
                    <i class="fas fa-gem me-2"></i> Est. 2017 - The First Cooperative
                </div>
            </div>
            
            <div class="col-lg-5 d-none d-lg-block">
                <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="hero-img.jpg" class="img-fluid rounded-3 shadow-lg" alt="Modern Jeepney 1" style="min-height: 400px; object-fit: cover; width: 100%;">
                        </div>
                        <div class="carousel-item">
                            <img src="hero-img-2.jpg" class="img-fluid rounded-3 shadow-lg" alt="Modern Jeepney 2" style="min-height: 400px; object-fit: cover; width: 100%;">
                        </div>
                        <div class="carousel-item">
                            <img src="hero-img-3.jpg" class="img-fluid rounded-3 shadow-lg" alt="Route Map View" style="min-height: 400px; object-fit: cover; width: 100%;">
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</section>

    <hr class="my-0">

   <section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-uppercase" style="color: var(--primary-color); font-size: 2.5rem;">Our Cooperative Vision</h2>
        <div class="row g-5 align-items-stretch">
            <div class="col-lg-7">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <h3 class="fw-bold mb-3" style="color: var(--primary-color); font-size: 1.8rem;">Pioneering Modern Transport</h3>
                    <p class="fs-6 lh-base text-justify" style="color: var(--dark-text); border-left: 5px solid var(--secondary-accent-color); padding-left: 15px;"><b>Batangas Transport Cooperative (BATRASCO)</b> is a duly registered transport cooperative established in <b>2017</b>, playing a pivotal role in managing and organizing public transportation within Batangas province.</p>
                    <p class="fs-6 lh-base text-justify" style="color: var(--dark-text); border-left: 5px solid var(--secondary-accent-color); padding-left: 15px;">As the first transport cooperative in Batangas to secure a P152.1 million loan from the Development Bank of the Philippines under the PASADA program, BATRASCO has been at the forefront of the <b>Public Utility Vehicle (PUV) Modernization Program</b>.</p> 
                    <p class="fs-6 lh-base text-justify" style="color: var(--dark-text); border-left: 5px solid var(--secondary-accent-color); padding-left: 15px;">We proudly serve the communities of Lipa, Batangas City, Mataas Na Kahoy, Rosario, San Juan, and Bauan, providing safe, comfortable, and efficient transportation for thousands of passengers daily.</p>
                </div>
            </div>
            
            <div class="col-lg-5 d-flex flex-column">
                <div class="metrics-block h-100 d-flex flex-column">
                    <h3 class="text-uppercase fw-bold mb-4 border-bottom pb-2" style="color: var(--secondary-accent-color);">Key Operational Metrics</h3>
                    
                    <div class="row g-3 d-flex align-items-stretch flex-grow-1">
                        <div class="col-6 d-flex">
                            <div class="metric-item w-100">
                                <i class="fas fa-users"></i>
                                <h3>2K+</h3>
                                <p>Active Members</p>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <div class="metric-item w-100">
                                <i class="fas fa-bus"></i>
                                <h3>85+</h3>
                                <p>PUV Units</p>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <div class="metric-item w-100">
                                <i class="fas fa-route"></i>
                                <h3>8</h3>
                                <p>Active Routes</p>
                            </div>
                        </div>
                        <div class="col-6 d-flex">
                            <div class="metric-item w-100">
                                <i class="fas fa-calendar-alt"></i>
                                <h3>2017</h3>
                                <p>Established</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <hr class="my-0">

    <section class="py-5" style="background-color: var(--inactive-color);">
        <div class="container">
            <h2 class="section-heading text-center">Fleet Technology Overview</h2>
            <div class="row g-4 d-flex align-items-stretch">
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="card h-100 showcase-card d-flex flex-column">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpFLIj4octmd0nTKVWWpQ-mN-jhvDP7rEIoA&s" class="card-img-top" alt="Air-Conditioned Jeepney">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: var(--dark-background);"><i class="fas fa-snowflake me-2" style="color: var(--primary-color);"></i>Air-Conditioned Comfort</h5>
                            <p class="card-text">Ergonomic seating and full air-conditioning ensure high passenger satisfaction for all routes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="card h-100 showcase-card d-flex flex-column">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpFLIj4octmd0nTKVWWpQ-mN-jhvDP7rEIoA&s" class="card-img-top" alt="Eco-Friendly Jeepney">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: var(--dark-background);"><i class="fas fa-leaf me-2" style="color: var(--green);"></i>Eco-friendly Technology</h5>
                            <p class="card-text">Euro 4-compliant engines significantly reduce the cooperative's environmental footprint in the region.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="card h-100 showcase-card d-flex flex-column">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpFLIj4octmd0nTKVWWpQ-mN-jhvDP7rEIoA&s" class="card-img-top" alt="Safe Jeepney">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: var(--dark-background);"><i class="fas fa-shield-alt me-2" style="color: var(--red);"></i>Advanced Safety Features</h5>
                            <p class="card-text">Mandatory CCTV monitoring and advanced safety features for secure, regulated travel across Batangas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-0">

    <section class="py-5">
        <div class="container">
            <h2 class="section-heading text-center">Modern Features and Amenities</h2>
            <div class="row g-4 d-flex align-items-stretch">
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="card h-100 feature-card text-center d-flex flex-column">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt fa-3x"></i>
                            <h5 class="card-title fw-bold mt-2" style="color: var(--dark-background);">GPS Real-Time Tracking</h5>
                            <p class="card-text">Advanced GPS systems allow real-time vehicle tracking for enhanced safety, route monitoring, and efficient fleet management.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="card h-100 feature-card text-center d-flex flex-column">
                        <div class="card-body">
                            <i class="fas fa-credit-card fa-3x" style="background-color: var(--secondary-accent-color);"></i>
                            <h5 class="card-title fw-bold mt-2" style="color: var(--dark-background);">Automated Fare System</h5>
                            <p class="card-text">Convenient cashless payment options through automated fare collection systems for a seamless travel experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="card h-100 feature-card text-center d-flex flex-column">
                        <div class="card-body">
                            <i class="fas fa-video fa-3x" style="background-color: var(--green);"></i>
                            <h5 class="card-title fw-bold mt-2" style="color: var(--dark-background);">CCTV Security</h5>
                            <p class="card-text">Multiple CCTV cameras installed in each unit ensure passenger safety and security throughout the journey.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="card h-100 feature-card text-center d-flex flex-column">
                        <div class="card-body">
                            <i class="fas fa-wifi fa-3x" style="background-color: var(--green);"></i>
                            <h5 class="card-title fw-bold mt-2" style="color: var(--dark-background);">Free Onboard Wi-Fi</h5>
                            <p class="card-text">Stay connected during your journey with complimentary Wi-Fi service available on all modern units.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="card h-100 feature-card text-center d-flex flex-column">
                        <div class="card-body">
                            <i class="fas fa-tachometer-alt fa-3x" style="background-color: var(--blue);"></i>
                            <h5 class="card-title fw-bold mt-2" style="color: var(--dark-background);">Performance Monitoring</h5>
                            <p class="card-text">Digital systems track unit performance, fuel consumption, and driver efficiency for optimized operations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="card h-100 feature-card text-center d-flex flex-column">
                        <div class="card-body">
                            <i class="fas fa-headset fa-3x" style="background-color: var(--orange);"></i>
                            <h5 class="card-title fw-bold mt-2" style="color: var(--dark-background);">24/7 Support</h5>
                            <p class="card-text">Dedicated command center for immediate coordination and response to operational issues or emergencies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 text-white" style="background-color: var(--dark-background);">
        <div class="container text-center">
            <h2 class="mb-5 fw-bold text-uppercase" style="font-size: 2.5rem; color: var(--secondary-accent-color);">Connect With Us</h2>
            
            <div class="row g-4 d-flex align-items-stretch">
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="contact-item-new w-100">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5 class="card-title fw-bold" style="color: var(--orange);">Main Office & Operations</h5>
                        <p class="card-text" style="color: var(--light);">Mataas Na Kahoy, Batangas</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="contact-item-new w-100">
                        <i class="fas fa-bus-alt"></i>
                        <h5 class="card-title fw-bold" style="color: var(--orange);">Primary Service Areas</h5>
                        <p class="card-text" style="color: var(--light);">Lipa City · Batangas City · San Juan · Bauan</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="contact-item-new w-100">
                        <i class="fas fa-envelope"></i>
                        <h5 class="card-title fw-bold" style="color: var(--orange);">Inquiries & Feedback</h5>
                        <p class="card-text" style="color: var(--light);">Visit our Facebook page for business inquiries.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <footer class="py-3 text-white" style="background-color: var(--primary-color);">
        <div class="container text-center">
            <p class="mb-0 small">&copy; 2025 BATRASCO - Batangas Transportation Corporation • <i>All rights reserved.</i></p>
            <div class="social-links">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>