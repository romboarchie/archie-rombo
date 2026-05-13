<?php get_header();?>

<?php 
// Determine if page has content
$has_content = false;
if(have_posts()){
    while(have_posts()){
        the_post();
        if(!empty(get_the_content())){
            $has_content = true;
        }
    }
    rewind_posts();
}
?>

<!-- Show default content only if page is empty -->
<?php if(!$has_content): ?>

<!-- ========================================
     HERO SLIDER SECTION
     ======================================== -->
<?php if ( get_theme_mod( 'archie_rombo_enable_hero_section', 1 ) ) : ?>
<section class="hero-slider">
    <div id="carouselHeroSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselHeroSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselHeroSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselHeroSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Carousel Inner -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 500px; display: flex; align-items: center; justify-content: center;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center">
                    <h1 class="display-3 fw-bold text-white mb-4">Welcome to Our Website</h1>
                    <p class="lead text-white mb-4">Discover amazing content and services</p>
                    <a href="#" class="btn btn-light btn-lg">Get Started</a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); height: 500px; display: flex; align-items: center; justify-content: center;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center">
                    <h1 class="display-3 fw-bold text-white mb-4">Innovative Solutions</h1>
                    <p class="lead text-white mb-4">Experience excellence in every aspect</p>
                    <a href="#" class="btn btn-light btn-lg">Learn More</a>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); height: 500px; display: flex; align-items: center; justify-content: center;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center">
                    <h1 class="display-3 fw-bold text-white mb-4">Quality & Expertise</h1>
                    <p class="lead text-white mb-4">Professional services tailored to your needs</p>
                    <a href="#" class="btn btn-light btn-lg">Contact Us</a>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHeroSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHeroSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<?php endif; ?>
    <div id="carouselHeroSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselHeroSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselHeroSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselHeroSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Carousel Inner -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 500px; display: flex; align-items: center; justify-content: center;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center">
                    <h1 class="display-3 fw-bold text-white mb-4">Welcome to Our Website</h1>
                    <p class="lead text-white mb-4">Discover amazing content and services</p>
                    <a href="#" class="btn btn-light btn-lg">Get Started</a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); height: 500px; display: flex; align-items: center; justify-content: center;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center">
                    <h1 class="display-3 fw-bold text-white mb-4">Innovative Solutions</h1>
                    <p class="lead text-white mb-4">Experience excellence in every aspect</p>
                    <a href="#" class="btn btn-light btn-lg">Learn More</a>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); height: 500px; display: flex; align-items: center; justify-content: center;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center text-center">
                    <h1 class="display-3 fw-bold text-white mb-4">Quality & Expertise</h1>
                    <p class="lead text-white mb-4">Professional services tailored to your needs</p>
                    <a href="#" class="btn btn-light btn-lg">Contact Us</a>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHeroSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHeroSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- ========================================
     ABOUT SECTION
     ======================================== -->
<section class="about-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-title mb-4">About Us</h2>
                <p class="lead">Welcome to our platform where innovation meets excellence. We're dedicated to providing the best solutions and services to our valued clients.</p>
                <p>Our team of experienced professionals is committed to delivering high-quality results that exceed expectations. With years of industry experience, we understand what it takes to succeed in today's competitive market.</p>
                <div class="mt-4">
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-success"></i> <strong>Professional Team</strong> - Expert professionals ready to assist</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success"></i> <strong>Quality Service</strong> - Committed to excellence</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success"></i> <strong>24/7 Support</strong> - Always here to help</li>
                    </ul>
                </div>
                <a href="#" class="btn btn-primary btn-lg mt-4">Learn More About Us</a>
            </div>
            <div class="col-lg-6">
                <div class="about-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 400px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-image fa-5x text-white opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SERVICES SECTION
     ======================================== -->
<section class="services-section py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title mb-4">Our Services</h2>
                <p class="lead">We offer a comprehensive range of services designed to meet your needs</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 p-4 bg-white rounded-3 shadow-sm text-center">
                    <div class="service-icon mb-3">
                        <i class="fas fa-rocket fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Innovation</h4>
                    <p>We leverage cutting-edge technology to provide innovative solutions tailored to your specific requirements.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 p-4 bg-white rounded-3 shadow-sm text-center">
                    <div class="service-icon mb-3">
                        <i class="fas fa-shield-alt fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Security</h4>
                    <p>Your data security is our priority. We implement industry-leading security measures to protect your information.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100 p-4 bg-white rounded-3 shadow-sm text-center">
                    <div class="service-icon mb-3">
                        <i class="fas fa-headset fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-3">Support</h4>
                    <p>Our dedicated support team is available 24/7 to assist you with any questions or concerns you may have.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     FEATURED CONTENT SECTION
     ======================================== -->
<section class="featured-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title mb-4">Featured Work</h2>
                <p class="lead">Explore some of our recent projects and achievements</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="featured-card h-100 rounded-3 overflow-hidden shadow-sm bg-white">
                    <div class="featured-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); height: 250px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image fa-5x text-white opacity-50"></i>
                    </div>
                    <div class="p-4">
                        <h5 class="mb-2">Project One</h5>
                        <p class="text-muted mb-3">A brief description of this featured project and its achievements.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="featured-card h-100 rounded-3 overflow-hidden shadow-sm bg-white">
                    <div class="featured-image" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); height: 250px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image fa-5x text-white opacity-50"></i>
                    </div>
                    <div class="p-4">
                        <h5 class="mb-2">Project Two</h5>
                        <p class="text-muted mb-3">Highlighting the success and impact of our second featured project.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="featured-card h-100 rounded-3 overflow-hidden shadow-sm bg-white">
                    <div class="featured-image" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); height: 250px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image fa-5x text-white opacity-50"></i>
                    </div>
                    <div class="p-4">
                        <h5 class="mb-2">Project Three</h5>
                        <p class="text-muted mb-3">Showcasing the innovation and excellence in our recent work.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     CALL TO ACTION SECTION
     ======================================== -->
<section class="cta-section py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white">
                <h2 class="display-4 fw-bold mb-4">Ready to Get Started?</h2>
                <p class="lead mb-4">Join thousands of satisfied clients who trust us with their needs</p>
                <a href="<?php echo get_permalink(get_page_by_title('Contact Us')); ?>" class="btn btn-light btn-lg">Contact Us Today</a>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<!-- ========================================
     PAGE CONTENT
     ======================================== -->
<section class="page-content py-5">
    <div class="container">
        <?php the_content(); ?>
    </div>
</section>

<?php get_footer();?>