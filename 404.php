<?php get_header(); ?>

<main class="container py-5">
	<section class="row justify-content-center text-center">
		<div class="col-lg-8">
			<h1 class="display-1 fw-bold">404</h1>
			<p class="lead mb-4">
				<?php esc_html_e( 'Sorry, that page cannot be found.', 'archie-rombo' ); ?>
			</p>
			<p class="mb-4 text-muted">
				<?php esc_html_e( 'Try searching for the content you need or use one of the links below.', 'archie-rombo' ); ?>
			</p>
			<div class="mb-4">
				<?php get_search_form(); ?>
			</div>
			<div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mb-5">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg">
					<?php esc_html_e( 'Back to Homepage', 'archie-rombo' ); ?>
				</a>
				<?php if ( get_option( 'page_for_posts' ) ) : ?>
					<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn-outline-secondary btn-lg">
						<?php esc_html_e( 'Visit Blog', 'archie-rombo' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="row">
		<div class="col-md-6 mb-4">
			<div class="card h-100 border-0 shadow-sm">
				<div class="card-body">
					<h2 class="h5 mb-3"><?php esc_html_e( 'Recent Posts', 'archie-rombo' ); ?></h2>
					<ul class="list-unstyled">
						<?php
						$recent_posts = wp_get_recent_posts(
							array(
								'numberposts' => 5,
								'post_status' => 'publish',
							)
						);
						foreach ( $recent_posts as $recent ) :
							?>
							<li class="mb-2">
								<a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>" class="text-decoration-none">
									<?php echo esc_html( wp_trim_words( $recent['post_title'], 10, '...' ) ); ?>
								</a>
							</li>
							<?php
						endforeach;
						wp_reset_postdata();
						?>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-6 mb-4">
			<div class="card h-100 border-0 shadow-sm">
				<div class="card-body">
					<h2 class="h5 mb-3"><?php esc_html_e( 'Popular Categories', 'archie-rombo' ); ?></h2>
					<ul class="list-unstyled">
						<?php
						$categories = get_categories(
							array(
								'orderby' => 'count',
								'order'   => 'DESC',
								'number'  => 8,
							)
						);
						foreach ( $categories as $category ) :
							?>
							<li class="mb-2">
								<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="text-decoration-none">
									<?php echo esc_html( $category->name ); ?>
									<span class="text-muted">(<?php echo esc_html( $category->count ); ?>)</span>
								</a>
							</li>
							<?php
						endforeach;
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>