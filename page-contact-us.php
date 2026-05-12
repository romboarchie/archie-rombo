<?php 
   /**
 * The template for Contact Us Page.
 *
 * 
 *
 * 
 */
 





    get_header();




    ?>
    
<div class="container" style="padding-top: 3rem;">
		<div class="row">
				<div class="col-sm-3">
					<h2><?php the_title(); ?></h2>
				</div>
				<div class="col-sm-4 offset-sm-5">
					<nav aria-label="Page navigation example" style="margin-top: 2rem;">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="<?php echo get_home_url('/'); ?>">Home</a></li>
    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
    <li class="page-item"><a class="page-link" href="#"><?php the_title(); ?></a></li>
    
  </ul>
</nav>
				</div>
			</div>
</div>

		<div class="container-fluid" style="padding: 3rem 0;">
		<div class="container">
			<!-- Contact Details and Form Row -->
			<div class="row mb-5">
				<!-- Contact Details Column -->
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="contact-details">
						<h3 class="mb-4">Contact Details</h3>
						
						<div class="contact-item mb-4">
							<h5 class="fw-bold mb-2">
								<i class="fas fa-map-marker-alt"></i> Address
							</h5>
							<p>123 Main Street<br>City, State 12345<br>Country</p>
						</div>

						<div class="contact-item mb-4">
							<h5 class="fw-bold mb-2">
								<i class="fas fa-phone"></i> Phone
							</h5>
							<p><a href="tel:+1234567890">+1 (234) 567-890</a></p>
						</div>

						<div class="contact-item mb-4">
							<h5 class="fw-bold mb-2">
								<i class="fas fa-envelope"></i> Email
							</h5>
							<p><a href="mailto:info@example.com">info@example.com</a></p>
						</div>

						<div class="contact-item">
							<h5 class="fw-bold mb-2">
								<i class="fas fa-clock"></i> Business Hours
							</h5>
							<p>Monday - Friday: 9:00 AM - 6:00 PM<br>
							Saturday: 10:00 AM - 4:00 PM<br>
							Sunday: Closed</p>
						</div>
					</div>
				</div>

				<!-- Contact Form Column -->
				<div class="col-lg-8 col-md-6">
					<div class="contact-form">
						<h3 class="mb-4">Send us a Message</h3>
						<form method="POST" action="" class="needs-validation">
							<div class="row">
								<div class="col-md-6 mb-3" style="padding-right: 1.5rem;">
									<label for="firstName" class="form-label">First Name *</label>
									<input type="text" class="form-control" id="firstName" name="firstName" required>
									<div class="invalid-feedback">
										Please provide your first name.
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<label for="lastName" class="form-label">Last Name *</label>
									<input type="text" class="form-control" id="lastName" name="lastName" required>
									<div class="invalid-feedback">
										Please provide your last name.
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6 mb-3" style="padding-right: 1.5rem;">
									<label for="email" class="form-label">Email *</label>
									<input type="email" class="form-control" id="email" name="email" required>
									<div class="invalid-feedback">
										Please provide a valid email address.
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<label for="phone" class="form-label">Phone</label>
									<input type="tel" class="form-control" id="phone" name="phone">
								</div>
							</div>

							<div class="mb-3">
								<label for="subject" class="form-label">Subject *</label>
								<input type="text" class="form-control" id="subject" name="subject" required>
								<div class="invalid-feedback">
									Please provide a subject.
								</div>
							</div>

							<div class="mb-3">
								<label for="message" class="form-label">Message *</label>
								<textarea class="form-control" id="message" name="message" rows="5" required></textarea>
								<div class="invalid-feedback">
									Please provide a message.
								</div>
							</div>

							<button type="submit" class="btn btn-primary btn-lg">Send Message</button>
						</form>
					</div>
				</div>
			</div>

			<!-- Google Map Section -->
			<div class="row mb-5">
				<div class="col-12">
					<h3 class="mb-4">Find Us On Map</h3>
					<div class="map-container" style="position: relative; width: 100%; overflow: hidden; ">
						<iframe 
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8087786253786!2d36.818133068208034!3d-1.288938995823053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10d844cb44d5%3A0x8400193d944f808f!2sKICC%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1778579630828!5m2!1sen!2ske" 
						width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
					</iframe>
					</div>
					<p class="text-muted mt-3 small">
						<em>Note: Replace the embedded map URL with your actual location coordinates. Get your map embed code from <a href="https://www.google.com/maps" target="_blank">Google Maps</a>.</em>
					</p>
				</div>
			</div>

			<!-- Page Content -->
			<div class="row">
				<div class="col-12">
					<?php
					if(have_posts()){
						while(have_posts()){
							the_post();
							get_template_part('template-parts/content','page');
						}
					}
					?>
				</div>
			</div>
		</div>
    </div>
	    
 <?php get_footer();?>