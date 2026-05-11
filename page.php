
    <?php get_header();?>
    
    <?php 
    $global_sidebar_pos = get_option('archie_rombo_sidebar_position', 'right');
    $meta_sidebar_pos   = get_post_meta(get_the_ID(), '_archie_rombo_sidebar_layout', true);
    $container_width    = get_option('archie_rombo_container_width', 'fluid');
    $sidebar_width_opt  = get_option('archie_rombo_sidebar_width', '3');
    
    $sidebar_pos = ($meta_sidebar_pos && $meta_sidebar_pos !== 'default') ? $meta_sidebar_pos : $global_sidebar_pos;
    $container_class = ($container_width === 'boxed') ? 'container' : 'container-fluid';

    $content_columns = 12 - absint($sidebar_width_opt);
    $sidebar_columns = absint($sidebar_width_opt);

    $content_class = 'col-lg-' . $content_columns . ' col-md-12';
    $sidebar_class = 'col-lg-' . $sidebar_columns . ' col-md-12';
    
    if ($sidebar_pos === 'none' || !is_active_sidebar('page-sidebar')) {
        $content_class = 'col-12';
    }
    ?>

    <div class="<?php echo esc_attr($container_class); ?> mb-5" style="padding-left: 2rem;padding-right: 2rem;">
        <div class="row">
            <?php if ($sidebar_pos === 'left' && is_active_sidebar('page-sidebar')) : ?>
                <aside class="<?php echo esc_attr($sidebar_class); ?> order-2 order-lg-1" id="sidebar">
                    <?php dynamic_sidebar('page-sidebar'); ?>
                </aside>
            <?php endif; ?>

            <main class="<?php echo esc_attr($content_class); ?> order-1 <?php echo ($sidebar_pos === 'left') ? 'order-lg-2' : ''; ?>">
                <?php
                if(have_posts()){
                    while(have_posts()){
                        the_post();
                        get_template_part('template-parts/content','page');
                    }
                }
                ?>
            </main>

            <?php if ($sidebar_pos === 'right' && is_active_sidebar('page-sidebar')) : ?>
                <aside class="<?php echo esc_attr($sidebar_class); ?> order-2" id="sidebar">
                    <?php dynamic_sidebar('page-sidebar'); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
	    
 <?php get_footer();?>