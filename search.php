<?php get_header();?>

<section class="page-wrap">
	<div class="container-fluid" style="--bs-gutter-x: 1.5rem;width: 95%;">
		
				
				<!--add content of /includes/section-archive.php to this page-->
				<h1>Search Results for '<?php echo get_search_query(); ?>'</h1>
				<p><?php get_search_form(); ?></p>

				<?php get_template_part('includes/section','searchresults');?>


				<!-- pagination developer style-->
				<?php previous_posts_link();?>
				<?php next_posts_link();?>







				<!--pagination wordpress style-->
				<?php
				//global $wp_query;

				//$big = 999999999; // need an unlikely integer
				//$translated = __( 'Page', 'archie-rombo' ); // Supply translatable string

				//echo paginate_links( array(
					//'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					//'format' => '?paged=%#%',
					//'current' => max( 1, get_query_var('paged') ),
					//'total' => $wp_query->max_num_pages,
			      // 'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
				//) );
				?>
			<!--pagination wordpress style-->





	</div>
</section>
<?php get_footer();?>