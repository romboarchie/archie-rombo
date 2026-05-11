<div class="container-fluid" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="content-header">
		<div class="meta mb-3">
			<!--date of publication-->
			<span class="date">&nbsp;<?php the_date(  'F j, Y' ); ?></span>
			<?php
			//post tags
			the_tags('<span class="tag"><i class="fa fa-tag"></i>','</span><span class="tag"><i class="fa fa-tag"></i>','</span>');
			?>
			<!--post category/s-->
			<span class="tag"><i class='fa fa-tag'></i> <?php the_category( ', ' ); ?></span>

			<span class="comment"><a href="#comments"><i class='fa fa-comment'></i> <?php comments_number();?></a></span>

			<h2 class="entry-title mb-1"><a href="<?php the_permalink();?>"><?php the_title_attribute(); ?></a></h2><br>

			<?php if ( has_post_thumbnail()) : ?>
			<img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt="<?php the_title(); ?>">

			<?php endif; ?>
		</div>
	</header>
	<?php
the_content();?>
<?php 
the_post_navigation( 
	array(
		'prev_text'	=> __( '<span class="nav-link-text">prev post</span><h3 class="entry-title">%title</h3>','archie-rombo' ),
		'next_text'	=> __( '<span class="nav-link-text">Next Post</span><h3 class="entry-title">%title</h3>','archie-rombo' ),
		'in_same_term'	=> true,
		
			
		) 
);
?>
<?php 
comments_template();


?>

</div>
