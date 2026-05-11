<?php
/**
 * The template for displaying articles in the search loop
 *
 * 
 */

?>



<!-- 
<?php if(have_posts() ): while(have_posts() ): the_post();?>

	
<div class="card mb-3">
	  <div class="card-body d-flex justify-content-center align-items-center">
	  	<?php if(has_post_thumbnail()):?>
      <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class="img-fluid mb-3 img-thumbnail mr-4">
    <?php endif;?>
    <div class="blog-content">
	  
	  	<h3 class="card-title"><?php the_title();?></h3>

		
		<p class="card-text"><?php the_excerpt();?> </p>

		
		<a class="btn btn-success" href="<?php the_permalink(); ?>">Read More</a>
	</div>
</div>
</div>

<?php endwhile;else:?>

No Search Results for '<?php echo get_search_query(); ?>'

<?php  endif;?> -->








<?php if(have_posts() ): while(have_posts() ): the_post();?>
	<div  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container-fluid">
		<div class="row ">
			<div class="col-sm-4">
				<?php if(has_post_thumbnail()): ?>
				<a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
					<img src="<?php the_post_thumbnail_url('blog-large');  ?>" class="img-fluid" alt="<?php the_title(); ?>">
				</a>
				
			
			<?php else:
				echo 'No Thumbail Found';
			endif;
			?>
			</div>
			<div class="col-sm-8" style="padding-left: 1rem;">
				<div class="meta mb-1">
					<span class="date"><?php the_date(); ?></span>
					<span class="comment"><a href="#"><?php comments_number();?></a></span>
					<span class="meta-category"> <?php  the_category( ', ' );?> </span>
				</div>
				<h2 class="entry-title mb-1"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
				
				<div class="entry-content entry-excerpt clearfix" style="text-align: justify;"><?php the_excerpt(); ?>
				<a class="more-link" href="<?php the_permalink();?>">Read more &rarr;</a>
				</div>
			</div>
		</div>
	</div>
</div>

	<hr>

	<?php endwhile;else:?>

No Search Results for '<?php echo get_search_query(); ?>'

<?php  endif;?>