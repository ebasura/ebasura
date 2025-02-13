<?php

include_once "init.php";

if (isset($_GET["ref"])) {
    Session::unsetSession("tfaChallenge");
    Session::unsetSession("uid");
}

if (isset($_GET["ref_"])) {
    Cookie::clear("remember_me");
    Cookie::clear("uid");
}

if ($login->isLoggedIn()) {
    header("Location: index.php");
    die();
}

if ($login->isTfaLoggedIn()) {
    header("Location: challenge.php");
}

if ($login->isRememberSet()) {
    $user = new User();
    $user_id = Cookie::get("uid");
    $uid = Others::decryptData($user_id, ENCRYPTION_KEY);
    $row = $user->getUserData($uid);

    if(empty($row)){
        Cookie::clear("remember_me");
        Cookie::clear("uid");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Landing Page | E-Basura</title>
    <!-- Android Chrome -->
    <link rel="icon" sizes="192x192" href="assets/img/android-chrome-192x192.png">
    <link rel="icon" sizes="512x512" href="assets/img/android-chrome-512x512.png">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">

    <!-- Web App Manifest -->
    <link rel="manifest" href="assets/img/site.webmanifest">

    <link href="css/index.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <style>
    .my-login-page .brand {
        width: 90px;
        height: 90px;
        overflow: hidden;
        border-radius: 50%;
        margin: 0 auto;
        margin: 40px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, .05);
        position: relative;
        z-index: 1;
    }

    .my-login-page .brand img {
        width: 100%;
    }

    .my-login-page .card-wrapper {
        width: 400px;
    }

    .my-login-page .card {
        border-color: transparent;
        box-shadow: 0 4px 8px rgba(0, 0, 0, .05);
    }

    .my-login-page .card.fat {
        padding: 10px;
    }

    .my-login-page .card .card-title {
        margin-bottom: 30px;
    }

    .my-login-page .form-control {
        border-width: 2.3px;
    }

    .my-login-page .form-group label {
        width: 100%;
    }

    .my-login-page .btn.btn-block {
        padding: 12px 10px;
    }

    .my-login-page .footer {
        margin: 40px 0;
        color: #888;
        text-align: center;
    }
    </style>
</head>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <!-- Navbar-->
                <nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
                    <div class="container px-5">
                        <a class="navbar-brand text-white" href="index.html">E-Basura</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto me-lg-5">
                                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>

                            </ul>
                            <button class="btn fw-500 ms-lg-4 btn-teal" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Login
                                <i class="ms-2" data-feather="arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </nav>
                <!-- Page Header-->
                <header class="page-header-ui page-header-ui-dark bg-gradient-primary-to-secondary">
                    <div class="page-header-ui-content pt-10">
                        <div class="container px-5">
                            <div class="row gx-5 align-items-center">
                                <div class="col-lg-6" data-aos="fade-up">
                                    <h1 class="page-header-ui-title">Welcome to E-Basura</h1>
                                    <p class="page-header-ui-text mb-5">
                                        This study developed an IoT-based waste segregation system at ISPSC using image
                                        processing technology. The system aims to improve waste management efficiency
                                        through automation.
                                    </p>
                                    <a class="btn btn-teal fw-500 me-2" href="#!">
                                        Get Started
                                        <i class="ms-2" data-feather="arrow-right"></i>
                                    </a>
                                    <a class="btn btn-link fw-500" href="#!">Learn More</a>
                                </div>
                                <div class="col-lg-6 d-none d-lg-block" data-aos="fade-up" data-aos-delay="100"><img
                                        class="img-fluid"
                                        src="http://localhost/ebasura/assets/img/android-chrome-512x512.png" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-white">
                        <!-- Rounded SVG Border-->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                            fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </header>
                <section class="bg-white py-10">
                    <div class="container px-5">
                        <div class="row gx-5 text-center">
                            <div class="col-lg-3 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                                    <i class="fas fa-broom"></i></div>
                                <h3>Clean As You Go</h3>
                                <p class="mb-0">(CLAYGO) encourages everyone to take responsibility for cleaning up
                                    after themselves. By reducing littering and maintaining cleanliness, we create a
                                    more inviting environment for all students and staff. Let's all contribute to a tidy
                                    and respectful campus!</p>
                            </div>
                            <div class="col-lg-3 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                                    <i class="fas fa-trash"></i></div>
                                <h3>Dispose Waste Responsibly</h3>
                                <p class="mb-0">Always use designated trash bins for waste disposal. Proper waste
                                    management not only keeps the campus looking clean, but it also promotes a healthier
                                    environment for everyone. Let's all take responsibility for maintaining a beautiful
                                    school campus.</p>
                            </div>
                            <div class="col-lg-3">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                                    <i class="fas fa-recycle"></i></div>
                                <h3>Practice Smart Waste Segregation</h3>
                                <p class="mb-0">Separate recyclable materials from non-recyclables to support our
                                    school's waste management system. Proper segregation helps make recycling more
                                    effective and reduces the amount of waste that ends up in landfills. Together, we
                                    can create a greener, cleaner campus.</p>
                            </div>
                            <div class="col-lg-3">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                                    <i class="fas fa-tree"></i></div>
                                <h3>Keep Our Campus Clean</h3>
                                <p class="mb-0">Avoid littering by always carrying your trash until you find a proper
                                    bin. Encourage others to do the same, helping to keep the campus a welcoming and
                                    pleasant space for learning. A clean school fosters pride and a sense of community!
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="svg-border-rounded text-light">
                        <!-- Rounded SVG Border-->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                            fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </section>

                <section class="bg-light py-10">
                    <div class="container px-5">
                        <div class="row gx-5 align-items-center justify-content-center">
                            <div class="col-md-9 col-lg-6 order-1 order-lg-0" data-aos="fade-right">
                                <div id="systemImageCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <!-- Slide 1 -->
                                        <div class="carousel-item active">
                                            <img class="d-block w-100 shadow-lg rounded-3"
                                                src="assets/images/carousel/1.png"
                                                alt="IoT-based Waste Segregation System 1">
                                        </div>
                                        <!-- Slide 2 -->
                                        <div class="carousel-item">
                                            <img class="d-block w-100 shadow-lg rounded-3"
                                                src="assets/images/carousel/2.png"
                                                alt="IoT-based Waste Segregation System 2">
                                        </div>
                                    </div>
                                    <!-- Carousel Controls -->
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#systemImageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#systemImageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-6 order-0 order-lg-1 mb-5 mb-lg-0" data-aos="fade-left">
                                <div class="mb-5">
                                    <h2>Key Features of the IoT Waste Segregation System</h2>
                                    <p class="lead">Our IoT-based system utilizes image processing technology to
                                        automate waste segregation and improve campus waste management efficiency.</p>
                                </div>
                                <div class="row gx-5">
                                    <div class="col-md-6 mb-4">
                                        <h6>Automated Waste Segregation</h6>
                                        <p class="mb-2 small">The system automatically sorts waste into categories,
                                            reducing human error and ensuring accurate segregation.</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6>Real-Time Monitoring</h6>
                                        <p class="mb-2 small">Monitor waste levels and segregation status in real-time
                                            to ensure timely disposal and maintenance.</p>
                                    </div>
                                </div>
                                <div class="row gx-5">
                                    <div class="col-md-6 mb-4">
                                        <h6>Efficient Waste Management</h6>
                                        <p class="mb-2 small">The system optimizes waste management, improving
                                            cleanliness and reducing operational costs.</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6>User-Friendly Interface</h6>
                                        <p class="small mb-0">Designed to be simple and intuitive, the system ensures
                                            easy adoption and use by students and staff.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-light py-10">
                    <div class="container px-5">
                        <div class="text-center mb-5">
                            <h2>See the IoT Waste Segregation System in Action</h2>
                            <p class="lead">Watch how our IoT-based system automatically segregates waste and improves
                                waste management efficiency on campus in real-time.</p>
                        </div>

                        <div class="row gx-5 justify-content-center mb-5">
                            <div class="col-lg-12">
                                <!-- Video Demo with larger size -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item w-100" height="500"
                                        src="https://www.youtube.com/embed/LpGq4vmzgl4" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>

                        <div class="row gx-5 justify-content-center mt-5">
                            <div class="col-lg-4 mb-4">
                                <div class="card text-center shadow-lg border-0 rounded-3">
                                    <div class="card-body py-4">
                                        <h5 class="card-title text-primary">Automatic Waste Sorting</h5>
                                        <p class="card-text">Using advanced image processing technology, our system
                                            automatically categorizes waste into recyclables, compost, and trash.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <div class="card text-center shadow-lg border-0 rounded-3">
                                    <div class="card-body py-4">
                                        <h5 class="card-title text-primary">Real-Time Monitoring</h5>
                                        <p class="card-text">Track waste levels and segregation status in real-time,
                                            ensuring timely disposal and maintenance across campus.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <div class="card text-center shadow-lg border-0 rounded-3">
                                    <div class="card-body py-4">
                                        <h5 class="card-title text-primary">Efficient Waste Management</h5>
                                        <p class="card-text">Minimize human error and optimize waste collection with our
                                            fully automated system, promoting sustainability campus-wide.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gx-5 justify-content-center text-center">
                            <div class="col-lg-8">
                                <a class="btn btn-primary fw-500" href="#!">Learn More</a>
                            </div>
                        </div>
                    </div>
                </section>


                <hr class="m-0" />
                <section class="bg-light pt-10">
                    <div class="container px-5">
                        <div class="text-center mb-5">
                            <h2>Meet the Team</h2>
                            <p class="lead">Our team of dedicated students working to bring innovation to waste
                                management with IoT technology.</p>
                        </div>
                        <div class="row gx-5 z-1">
                            <!-- Team Member 1 -->
                            <div class="col-lg-4 mb-5 mb-lg-n10" data-aos="fade-up" data-aos-delay="100">
                                <div class="card team-member h-100">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <img src="assets/images/members/cyanne.png" alt="Team Member 1"
                                                class="img-fluid rounded-circle mb-3" width="150" height="150" />
                                            <h4>Cyanne Justin Vega</h4>
                                            <p class="text-muted">Project Manager </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Team Member 2 -->
                            <div class="col-lg-4 mb-5 mb-lg-n10" data-aos="fade-up">
                                <div class="card team-member h-100">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <img src="assets/images/members/jade.jpg" alt="Team Member 2"
                                                class="img-fluid rounded-circle mb-3" width="150" height="150" />
                                            <h4>Jade Pablo</h4>
                                            <p class="text-muted">System Analyst and Designer <br>Documenter/Technical
                                                Writer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Team Member 3 -->
                            <div class="col-lg-4 mb-5 mb-lg-n10" data-aos="fade-up" data-aos-delay="100">
                                <div class="card team-member h-100">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <img src="assets/images/members/francis.jpeg" alt="Team Member 3"
                                                class="img-fluid rounded-circle mb-3" width="150" height="150" />
                                            <h4>Francis Xavier Ramos</h4>
                                            <p class="text-muted">System Analyst and Designer <br> Programmer </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gx-5 z-2 justify-content-center mt-5">
                            <!-- Team Member 4 -->
                            <div class="col-lg-4 mb-5 mt-5 mb-lg-n10" data-aos="fade-up" data-aos-delay="100">
                                <div class="card team-member h-100">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <img src="assets/images/members/alcel.jpg" alt="Team Member 4"
                                                class="img-fluid rounded-circle mb-3" width="150" height="150" />
                                            <h4>Alcel Marie Obaña</h4>
                                            <p class="text-muted">QA/Tester<br> Programmer </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Team Member 5 -->
                            <div class="col-lg-4 mb-5 mt-5 mb-lg-n10" data-aos="fade-up" data-aos-delay="100">
                                <div class="card team-member h-100">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <img src="assets/images/members/jl.jpg" alt="Team Member 5"
                                                class="img-fluid rounded-circle mb-3" width="150" height="150" />
                                            <h4>John Lloyd Andaya</h4>
                                            <p class="text-muted">QA/Tester</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-dark">
                        <!-- Rounded SVG Border-->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                            fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </section>


                <section class="bg-dark py-10">
                    <div class="container px-5">
                        <div class="row gx-5 my-10">
                            <!-- Question 1 -->
                            <div class="col-lg-6 mb-5">
                                <div class="d-flex h-100">
                                    <div class="icon-stack flex-shrink-0 bg-teal text-white"><i
                                            class="fas fa-question"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-white">What is our Capstone Project?</h5>
                                        <p class="text-white-50">Our project is an IoT-based waste segregation system
                                            aimed at automating and optimizing waste management on the ISPSC campus
                                            using image processing technology.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Question 2 -->
                            <div class="col-lg-6 mb-5">
                                <div class="d-flex h-100">
                                    <div class="icon-stack flex-shrink-0 bg-teal text-white"><i
                                            class="fas fa-question"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-white">What problem does the project solve?</h5>
                                        <p class="text-white-50">Our project addresses the issues of scattered garbage
                                            and improper waste segregation on the ISPSC campus by introducing a fully
                                            automated and efficient system.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Question 3 -->
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="d-flex h-100">
                                    <div class="icon-stack flex-shrink-0 bg-teal text-white"><i
                                            class="fas fa-question"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-white">How does the system work?</h5>
                                        <p class="text-white-50">The system uses IoT sensors and image processing
                                            algorithms to automatically segregate waste into different categories and
                                            monitor waste levels in real-time.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Question 4 -->
                            <div class="col-lg-6">
                                <div class="d-flex h-100">
                                    <div class="icon-stack flex-shrink-0 bg-teal text-white"><i
                                            class="fas fa-question"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-white">What is the impact of the project?</h5>
                                        <p class="text-white-50">Our system aims to improve campus cleanliness, optimize
                                            waste management processes, and reduce human error in waste segregation.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5 justify-content-center text-center">
                            <div class="col-lg-8">
                                <div class="badge bg-transparent-light rounded-pill badge-marketing mb-4">Get Involved
                                </div>
                                <h2 class="text-white">Be Part of the Change with Our Capstone Project</h2>
                                <p class="lead text-white-50 mb-5">Join us in creating a cleaner and more sustainable
                                    campus environment with our innovative IoT-based waste segregation system.</p>
                                <a class="btn btn-teal fw-500" href="#!">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-white">
                        <!-- Rounded SVG Border-->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                            fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </section>
                <section class="bg-white pt-10">
                    <div class="container px-5">
                        <div class="row gx-5 mb-10">
                            <!-- Testimonial 1 -->
                            <div class="col-lg-6 mb-5 mb-lg-0 divider-right" data-aos="fade">
                                <div class="testimonial p-lg-5">
                                    <p class="testimonial-quote text-primary">"The IoT-based waste segregation system
                                        has greatly improved waste management on our campus. It's automated and
                                        efficient, helping us stay organized while promoting sustainability."</p>
                                    <div class="testimonial-name">Jeff</div>
                                    <div class="testimonial-position">Student Leader, ISPSC</div>
                                </div>
                            </div>
                            <!-- Testimonial 2 -->
                            <div class="col-lg-6" data-aos="fade" data-aos-delay="100">
                                <div class="testimonial p-lg-5">
                                    <p class="testimonial-quote text-primary">"This project is a game-changer! It not
                                        only enhances cleanliness but also engages the entire campus community in
                                        keeping our environment safe and clean."</p>
                                    <div class="testimonial-name">Jeff</div>
                                    <div class="testimonial-position">Student, ISPSC</div>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5">
                            <!-- Feature 1 -->
                            <div class="col-lg-6 mb-lg-n10 mb-5 mb-lg-0 z-1">
                                <a class="card text-decoration-none h-100 lift" href="#!">
                                    <div class="card-body py-5">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-stack icon-stack-xl bg-primary text-white flex-shrink-0"><i
                                                    data-feather="activity"></i></div>
                                            <div class="ms-4">
                                                <h5 class="text-primary">Work smarter, not harder</h5>
                                                <p class="card-text text-gray-600">Learn more about how our system can
                                                    save time and effort in managing waste across the campus!</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Feature 2 -->
                            <div class="col-lg-6 mb-lg-n10 z-1">
                                <a class="card text-decoration-none h-100 lift" href="#!">
                                    <div class="card-body py-5">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-stack icon-stack-xl bg-secondary text-white flex-shrink-0">
                                                <i data-feather="code"></i></div>
                                            <div class="ms-4">
                                                <h5 class="text-secondary">Built for a cleaner environment</h5>
                                                <p class="card-text text-gray-600">Our IoT-based waste segregation
                                                    system is designed to make the campus cleaner and more sustainable
                                                    for everyone.</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-light">
                        <!-- Rounded SVG Border-->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                            fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </section>

                <section class="bg-light py-10">

                </section>
                <hr class="m-0" />
            </main>
        </div>
        <div id="layoutDefault_footer">
            <footer class="footer pt-10 pb-5 mt-auto bg-light footer-light">
                <div class="container px-5">
                    <div class="row gx-5">
                        <div class="col-lg-3">
                            <div class="footer-brand">E-Basura</div>
                            <div class="mb-3">IoT Waste Segregation System</div>
                            <div class="icon-list-social mb-5">
                                <a class="icon-list-social-link" href="#!"><i class="fab fa-facebook"></i></a>
                                <a class="icon-list-social-link" href="#!"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row gx-5">
                                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Project</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="#!">About</a></li>
                                        <li class="mb-2"><a href="#!">Features</a></li>
                                        <li><a href="#!">Contact</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                                    <div class="text-uppercase-expanded text-xs mb-4">Legal</div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><a href="#!">Privacy Policy</a></li>
                                        <li><a href="#!">Terms and Conditions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <div class="row gx-5 align-items-center">
                        <div class="col-md-6 small">Copyright © ISPSC 2025</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="#!">Privacy Policy</a>
                            ·
                            <a href="#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">    
                <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4">

                            <div class="card shadow-lg">
                            <div class="card-body p-5">
                            <!-- Check if 'Remember me' is set -->
                                    <?php if (!$login->isRememberSet()): ?>
                                    <h4 class="card-title">Login</h4>
                                    <?php else: ?>
                                    <h4 class="card-title">Login as <?= htmlentities($row["username"]) ?></h4>
                                    <?php endif; ?>

                                    <form method="POST" id="login_form">
                                        <input type="hidden" name="token" id="token"
                                            value="<?= htmlentities(CSRF::generate("login_form")) ?>">

                                        <!-- Username field (only show when 'Remember me' is not set) -->
                                        <?php if (!$login->isRememberSet()): ?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input id="username" type="text" class="form-control" name="username"
                                                autofocus>
                                        </div>
                                        <?php else: ?>
                                        <input id="username" type="hidden" class="form-control" name="username"
                                            value="<?= $row["username"] ?>" autofocus>
                                        <?php endif; ?>

                                        <!-- Password field -->
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#forgotPasswordModal" class="float-end">Forgot
                                                    password?</a>
                                            </label>
                                            <input id="password" type="password" class="form-control"
                                                name="password" data-eye>
                                        </div>

                                        <!-- Remember me checkbox (only show when 'Remember me' is not set) -->
                                        <?php if (!$login->isRememberSet()): ?>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" name="remember" id="remember"
                                                class="form-check-input">
                                            <label for="remember" class="form-check-label">Remember me</label>
                                        </div>
                                        <?php endif; ?>

                                        <!-- Login button -->
                                        <div class="mb-3">
                                            <button type="submit" id="login_button" class="btn btn-primary w-100">
                                                Log in
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="footer mt-4 text-center">
                                <?php if ($login->isRememberSet()): ?>
                                Not your account? <a href="login.php?ref_">Log in</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="assets/js/sha512.min.js"></script>
    <script src="assets/js/login.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init({
        disable: 'mobile',
        duration: 600,
        once: true,
    });
    </script>

</body>

</html>