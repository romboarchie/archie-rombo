<!doctype html>
<html <?php language_attributes(); ?>  class="h-100" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php  //add_theme_support( "title-tag" ); ?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(  ); ?> >
    <?php wp_body_open(); ?>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>
    <!-- Search Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <form action="./" method="get"  class="d-flex form-floating search-form"  style="margin: 2rem;"> 
              <input type="text" class="form-control me-2 search-field" name="s" id="search" placeholder="Search..." value="<?php the_search_query(); ?>" />
              <button type="submit" class="btn btn-success search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Search Modal -->
    <?php 
    $is_transparent = (is_front_page() && get_option('archie_rombo_transparent_header', 0)) ? 'is-transparent' : '';
    ?>
    <header class="<?php echo esc_attr($is_transparent); ?>">
      <div class="container-fluid top-bar 
        <?php
          if (is_user_logged_in()) {
            echo 'top-bar-logged-in';
          } else {
            echo 'top-bar-not-logged-in';
          }
        ?>" 
     ><!--Top bar-->
        <div class="row">
          <div class="col-sm-12 col-md-4"><!--theme_phone_number-->
            <?php
              $phone_number = get_option('theme_phone_number');
              if ($phone_number) {
                echo '<p style="margin-top: 0;margin-bottom: 0;"><span style="color: #b30;"><i class="fa fa-phone" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;<span style="color: #fff;">' . esc_html($phone_number) . '</span></p>';
              }else{
                echo '<span style="color: #fff;margin-top: 0;margin-bottom: 0;"><i class="fa fa-phone" aria-hidden="true"></i>+254-123-456-789</span>';
              }
            ?>
          </div><!--theme_phone_number-->
          <div class="col-sm-12 col-md-4"><!--theme_email-->
            <?php
              $theme_email = get_option('theme_email');
              if($theme_email){
                echo '<p class="text-start" style="margin-top: 0;margin-bottom: 0;"><span style="color: #b30;"><i class="fa-duotone fa-regular fa-envelope"></i></span>&nbsp;&nbsp;&nbsp;<span style="color: #fff;">' . esc_html($theme_email) . '</span></p>';
              }else{
                echo '<p class="text-center" style="color: #fff;margin-top: 0;margin-bottom: 0;"><i class="fa-duotone fa-regular fa-envelope"></i>archierombo@gmail.com</p>';
              }
            ?>
          </div><!--theme_email-->
          <div class="col-sm-12 col-md-4 text-md-end" style="text-transform: uppercase;"><!--WordPress Login & Registeration Link-->
            <?php
              echo '<a style="text-decoration: none;color: #b30;" href="' . wp_login_url() . '">Login&nbsp;<i class="fa-sharp-duotone fa-regular fa-right-to-bracket"></i></a>';
            ?>
            <span class="sep">&nbsp; |&nbsp; </span>
            <?php
              echo '<a style="text-decoration: none;color: #fff;" href="' . wp_registration_url() . '">Sign Up&nbsp;<i class="fa-duotone fa-solid fa-user-plus"></i></a>';
            ?>
        </div><!--WordPress Login & Registeration Link-->
      </div>
    </div><!--Top bar-->
    <nav class="site-main-nav navbar navbar-expand-lg bg-body-tertiary <?php echo get_option('archie_rombo_fixed_header') ? 'sticky-top' : ''; ?>" style="box-shadow: 0 0 20px rgba(0,0,0,0.15);">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo get_home_url('/'); ?>">
      	   <?php
            if ( function_exists( 'the_custom_logo' ) ) {
                the_custom_logo();
            }

  	       ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-menu">
          <?php
           wp_nav_menu(
				array(
					'theme_location' => 'main-menu',
					'container'      => false,
					'menu_class'     => '',
					'fallback_cb'    => '__return_false',
					'items_wrap'     => '<ul id="%1$s" class="navbar-nav nav mb-2 mb-md-0 me-auto %2$s">%3$s</ul>',
					'depth'          => 2,
					'walker'         => new Archie_Rombo_Bootstrap_Nav_Walker(),
				)
			);
    				 ?>		
            <div class="d-flex align-items-center">
                <?php get_search_form();?>
                
                <div class="dropdown ms-3 bd-mode-toggle">
                  <button class="btn btn-link nav-link py-2 dropdown-toggle d-flex align-items-center"
                          id="bd-theme"
                          type="button"
                          aria-expanded="false"
                          data-bs-toggle="dropdown"
                          aria-label="Toggle theme (auto)">
                    <svg class="bi my-1 theme-icon-active" width="1.2em" height="1.2em"><use href="#circle-half"></use></svg>
                    <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
                    <li>
                      <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                        <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
                        Light
                        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                      </button>
                    </li>
                    <li>
                      <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                        <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
                        Dark
                        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                      </button>
                    </li>
                    <li>
                      <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                        <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
                        Auto
                        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                      </button>
                    </li>
                  </ul>
                </div>
            </div>
    </div>
  </div>
</nav>
</header>
<?php 
$header_bg_id = get_option('archie_rombo_header_bg');
$header_bg_url = $header_bg_id ? wp_get_attachment_image_url($header_bg_id, 'full') : '';
?>
<section class="hero-section text-center text-white" style="<?php echo $header_bg_url ? 'background-image: url(' . esc_url($header_bg_url) . ');' : ''; ?>">
    <div class="hero-overlay"></div>
    <div class="container position-relative">
        <h1 class="display-4 fw-bold hero-title"><?php 
            if (is_front_page()) {
                bloginfo('description');
            } elseif (is_archive()) {
                the_archive_title();
            } elseif (is_search()) {
                printf( esc_html__( 'Search Results for: %s', 'archie-rombo' ), '<span>' . get_search_query() . '</span>' );
            } else {
                echo get_the_title();
            }
        ?></h1>
    </div>
</section>
<?php //the_title(); ?>