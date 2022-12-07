<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Skills Acquisition - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Vesperr - v4.9.1
    * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h1><a href="{{ route('home.index') }}">
                    <img src="{{ asset('/storage/images/'. $data->image) }}" alt="{{ $data->institution }}" width="130px"></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#services">Services</a></li>
                <li><a class="nav-link scrollto" href="#team">Mentors</a></li>
                <li><a class="nav-link scrollto " href="#portfolio">Business</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

                <li><a class="nav-link scrollto" href="{{ route('login') }}">Sign in</a></li>
                <li><a class="getstarted scrollto" href="{{ route('register') }}">Register</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex" style="height: 100%">

    <div class="container">
        <br>
        <div class="row">
            <div class="col-lg-6 pt-5 order-2 order-lg-1 d-flex flex-column justify-content-center">

                <h1 data-aos="fade-up">It's time to level up! Start your Skill Acquisition
                    <span style="color: #13c217; font-style: italic;">journey </span>with
                     {{ $data->institution }} </h1>
                <h6 data-aos="fade-up" data-aos-delay="400" style="text-align: justify;">At {{ $data->institution }}, we help members to
                    to focus mastering the field of their interest and also giving them the access to business incubation
                    </h6>
                <div data-aos="fade-up" data-aos-delay="800">
                    <a href="{{ route('register') }}" class="btn-get-started scrollto">Get Started</a>
                </div>
                <br>

            </div>
            <div class="col-lg-6 order-1" data-aos="fade-left" data-aos-delay="200">
                <img src="{{ asset('/img/skillsimg.png') }}" height="280px" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2 style="color: #035d05">Our Services</h2>
                <p></p>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div><img src="{{ asset('/img/learning_guide.png') }}" width="180px"></div>
                        <h4 class="title"><a href="" style="color: #067c09">Learning Guide</a></h4>
                        <p class="description">We will help you choose which path that is suitable for you.
                         These guides are used by and facilitated by instructors with learners.
                            They are designed to extend the learning in the self-paced modules</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <div><img src="{{ asset('/img/mentors.png') }}" width="180px"></div>
                        <h4 class="title"><a href="" style="color: #067c09">Mentorship</a></h4>
                        <p class="description">We ensure you have full access to Mentors in your specific skills. Mentors @elsewould be available to make your learning journey seamless and convinient. velit esse cillum dolore</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                        <div><img src="{{ asset('/img/incubation.png') }}" width="180px"></div>
                        <h4 class="title"><a href="" style="color: #067c09">Business Incubation</a></h4>
                        <p class="description">We won't leave you hanging, After the completion of the program @elseyou would have access to endless oppurtunities</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon"><i class="bx bx-world"></i></div>
                        <h4 class="title"><a href="" style="color: #067c09">Starter Packs</a></h4>
                        <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= More Services Section ======= -->
    <section id="more-services" class="more-services">
        <div class="container">

            <div class="row">
                <div class="col-md-6 d-flex align-items-stretch">
                            <img src="{{ asset('/img/first_pix.png') }}" width="100%" alt="skills_pix">
                </div>
                <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div style="padding-top: 250px">
                            <h5><a href="">Begin the Journey</a></h5>
                            <p>Learn a new Skill from Our Instructors and be equipped!</p>
                            <div class="btn btn-success btn-lg"><a href="{{ route('register') }}" style="color: white;">Get Started</a></div>
                        </div>
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div style="padding-top: 250px">
                        <h5><a href="">Complete Courses</a></h5>
                        <p>Finish the Course and get the opportunity to be matchmaked with efficient Mentor</p>
                        <div class="btn btn-success btn-lg"><a href="{{ route('register') }}" style="color: white;">Get Started</a></div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-stretch">
                    <img src="{{ asset('/img/second_pix.png') }}" width="100%" alt="skills_pix">
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-6 d-flex align-items-stretch">
                    <img src="{{ asset('/img/third_pix.png') }}" width="100%" alt="skills_pix">
                </div>
                <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div style="padding-top: 250px">
                        <h5><a href="">Mentorship</a></h5>
                        <p>Full access to Mentors in the same field</p>
                        <div class="btn btn-success btn-lg"><a href="{{ route('register') }}" style="color: white;">Get Started</a></div>
                    </div>
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div style="padding-top: 250px">
                        <h5><a href="">Business Incubation</a></h5>
                        <p>Put into practice what you have learnt in the course of the training</p>
                        <div class="btn btn-success btn-lg"><a href="{{ route('register') }}" style="color: white;">Get Started</a></div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-stretch">
                    <img src="{{ asset('/img/second_pix.png') }}" width="100%" alt="skills_pix">
                </div>

            </div>


        </div>
    </section><!-- End More Services Section -->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Contact Us</h2>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-about">
                        <h3>{{ $data->institution }}</h3>
                        <p>{{ $data->description }}</p>
                        <div class="social-links">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="info">
                        <div>
                            <i class="ri-map-pin-line"></i>
                            <p>{{ $data->address }}</p>
                        </div>

                        <div>
                            <i class="ri-mail-send-line"></i>
                            <p>{{ $data->email }}</p>
                        </div>

                        <div>
                            <i class="ri-phone-line"></i>
                            <p>{{ $data->phone }}</p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5 col-md-12" data-aos="fade-up" data-aos-delay="300">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 text-lg-left text-center">
                <div class="copyright">
                    &copy; Copyright <script>document.write(new Date().getFullYear())</script><strong> {{ $data->institution }}</strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/vesperr-free-bootstrap-template/ -->
                    {{--Designed by <a href="https://bootstrapmade.com/"></a>--}}
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                    <a href="#intro" class="scrollto">Home</a>
                    <a href="#about" class="scrollto">Services</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                </nav>
            </div>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>
