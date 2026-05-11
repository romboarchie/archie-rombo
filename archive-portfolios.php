<?php get_header();?>

<section class="page-wrap">
	<div class="container">
		<?php archie_rombo_breadcrumbs(); ?>
		<section class="row">
			<div class="col-xs-12 col-sm-12 col-lg-3">	
				 <?php if(is_active_sidebar('blog-sidebar')):?>

				 	<?php dynamic_sidebar('blog-sidebar');?>

				 <?php endif;?>
			</div>

			<div class="col-xs-12 col-sm-12 col-lg-9">
				<?php archie_rombo_portfolio_filter_bar(); ?>

				<h1>
					<?php
					$current_cat = isset( $_GET['cat'] ) ? absint( wp_unslash( $_GET['cat'] ) ) : 0;
					if ( $current_cat && get_cat_name( $current_cat ) ) {
						echo esc_html( get_cat_name( $current_cat ) );
					} else {
						post_type_archive_title();
					}
					?>
				</h1>

				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', 'archive' ); ?>
					<?php endwhile; ?>
				<?php else : ?>
					<p><?php esc_html_e( 'No portfolio items found.', 'archie-rombo' ); ?></p>
				<?php endif; ?>

				<div class="archive-pagination mt-4">
					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 2,
							'prev_text' => __( '&laquo;', 'archie-rombo' ),
							'next_text' => __( '&raquo;', 'archie-rombo' ),
						)
					);
					?>
				</div>






			</div>
		</section> 
	</div>
</section>
<?php get_footer();?>