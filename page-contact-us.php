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

		<div class="container-fluid">
		




			<?php
			if(have_posts()){
				while(have_posts()){
					the_post();
					get_template_part('template-parts/content','page');
					
				}
			}
			?>
	    
	    </div>
	    
 <?php get_footer();?>