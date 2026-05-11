<?php
/**
 * Archie Rombo Theme Dashboard
 * 
 * Handles the custom admin page for theme settings.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the custom menu page.
 */
function archie_rombo_register_options_page() {
    // Top Level Menu
    add_menu_page(
        __( 'Archie Rombo', 'archie-rombo' ),
        __( 'Archie Rombo', 'archie-rombo' ),
        'manage_options',
        'archie_rombo_dashboard',
        'archie_rombo_render_options_page',
        'dashicons-art',
        60
    );

    // Sub Menus
    add_submenu_page(
        'archie_rombo_dashboard',
        __( 'General Info', 'archie-rombo' ),
        __( 'General Info', 'archie-rombo' ),
        'manage_options',
        'archie_rombo_dashboard',
        'archie_rombo_render_options_page'
    );

    add_submenu_page(
        'archie_rombo_dashboard',
        __( 'Typography', 'archie-rombo' ),
        __( 'Typography', 'archie-rombo' ),
        'manage_options',
        'archie_rombo_typography',
        'archie_rombo_render_typography_page'
    );

    add_submenu_page(
        'archie_rombo_dashboard',
        __( 'Appearance', 'archie-rombo' ),
        __( 'Appearance', 'archie-rombo' ),
        'manage_options',
        'archie_rombo_appearance',
        'archie_rombo_render_appearance_page'
    );

    add_submenu_page(
        'archie_rombo_dashboard',
        __( 'Content & Social', 'archie-rombo' ),
        __( 'Content & Social', 'archie-rombo' ),
        'manage_options',
        'archie_rombo_social',
        'archie_rombo_render_social_page'
    );

    add_submenu_page(
        'archie_rombo_dashboard',
        __( 'Documentation', 'archie-rombo' ),
        __( 'Documentation', 'archie-rombo' ),
        'manage_options',
        'archie_rombo_docs',
        'archie_rombo_render_docs_page'
    );

    add_submenu_page(
        'archie_rombo_dashboard',
        __( 'Support', 'archie-rombo' ),
        __( 'Support', 'archie-rombo' ),
        'manage_options',
        'archie_rombo_support',
        'archie_rombo_render_support_page'
    );
}
add_action( 'admin_menu', 'archie_rombo_register_options_page' );

/**
 * Register settings.
 */
function archie_rombo_register_settings() {
    // Register the setting for Custom Logo (syncs with core)
    register_setting( 'archie_rombo_options_group', 'custom_logo', array(
        'sanitize_callback' => 'archie_rombo_sync_custom_logo'
    ) );

    // Register settings for Contact Info
    register_setting( 'archie_rombo_options_group', 'theme_phone_number', array( 'sanitize_callback' => 'sanitize_text_field' ) );
    register_setting( 'archie_rombo_options_group', 'theme_email', array( 'sanitize_callback' => 'sanitize_email' ) );

    // Register setting for Footer Copyright
    register_setting( 'archie_rombo_options_group', 'archie_rombo_footer_copyright', array( 
        'sanitize_callback' => 'wp_kses_post',
        'default' => '&copy; ' . date('Y') . ' Archie Rombo'
    ) );

    // Register setting for Blog Settings
    register_setting( 'archie_rombo_options_group', 'archie_rombo_read_more_text', array( 
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'Read More'
    ) );

    // Register Social Media Settings
    register_setting( 'archie_rombo_options_group', 'archie_rombo_facebook_url', array( 'sanitize_callback' => 'esc_url_raw' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_twitter_url', array( 'sanitize_callback' => 'esc_url_raw' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_instagram_url', array( 'sanitize_callback' => 'esc_url_raw' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_linkedin_url', array( 'sanitize_callback' => 'esc_url_raw' ) );

    // Register Typography Settings
    register_setting( 'archie_rombo_options_group', 'archie_rombo_body_font_size', array( 'sanitize_callback' => 'absint', 'default' => 17 ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_heading_font_size', array( 'sanitize_callback' => 'absint', 'default' => 36 ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_body_font_family', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'TitilliumWeb' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_heading_font_family', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'Amaranth' ) );

    // Additional Typography Settings
    register_setting( 'archie_rombo_options_group', 'archie_rombo_body_line_height', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '1.75' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_heading_line_height', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '1.4' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_body_font_weight', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'normal' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_heading_font_weight', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'bold' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_heading_transform', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'none' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_body_letter_spacing', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '0' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_heading_letter_spacing', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '0' ) );

    // Additional Color Settings
    register_setting( 'archie_rombo_options_group', 'archie_rombo_heading_color', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '' ) );

    // Button Styling Settings
    register_setting( 'archie_rombo_options_group', 'archie_rombo_button_radius', array( 'sanitize_callback' => 'absint', 'default' => 4 ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_button_padding_v', array( 'sanitize_callback' => 'absint', 'default' => 10 ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_button_padding_h', array( 'sanitize_callback' => 'absint', 'default' => 20 ) );

    // Header Background Settings
    register_setting( 'archie_rombo_options_group', 'archie_rombo_fixed_header', array( 'sanitize_callback' => 'absint', 'default' => 0 ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_transparent_header', array( 'sanitize_callback' => 'absint', 'default' => 0 ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_navbar_shrink', array( 'sanitize_callback' => 'absint', 'default' => 0 ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_mobile_topbar_hide', array( 'sanitize_callback' => 'absint', 'default' => 0 ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_header_bg', array( 'sanitize_callback' => 'absint' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_header_overlay_color', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '#000000' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_header_overlay_opacity', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '0.5' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_hero_padding', array( 'sanitize_callback' => 'absint', 'default' => 100 ) );

    // Social Icon Styling
    register_setting( 'archie_rombo_options_group', 'archie_rombo_social_icon_style', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'none' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_social_icon_color', array( 'sanitize_callback' => 'sanitize_hex_color', 'default' => '' ) );

    // Layout Settings
    register_setting( 'archie_rombo_options_group', 'archie_rombo_sidebar_position', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'right' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_sidebar_width', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => '3' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_container_width', array( 'sanitize_callback' => 'sanitize_text_field', 'default' => 'fluid' ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_back_to_top', array( 'sanitize_callback' => 'absint', 'default' => 1 ) );
    register_setting( 'archie_rombo_options_group', 'archie_rombo_navbar_height', array( 'sanitize_callback' => 'absint', 'default' => 80 ) );
}
add_action( 'admin_init', 'archie_rombo_register_settings' );

/**
 * Sync the custom_logo option with the theme_mod.
 * This ensures the logo works with standard WordPress functions like the_custom_logo().
 */
function archie_rombo_sync_custom_logo( $value ) {
    if ( empty( $value ) ) {
        remove_theme_mod( 'custom_logo' );
    } else {
        set_theme_mod( 'custom_logo', $value );
    }
    return $value;
}

/**
 * Render the options page HTML.
 */
/**
 * Render Logo Settings part.
 */
function archie_rombo_render_logo_field() {
    ?>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Custom Logo', 'archie-rombo' ); ?></th>
        <td>
            <?php
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $logo_url = $custom_logo_id ? wp_get_attachment_image_url( $custom_logo_id, 'full' ) : '';
            ?>
            <input type="hidden" id="custom_logo" name="custom_logo" value="<?php echo esc_attr( $custom_logo_id ); ?>">
            <div id="logo-preview-wrapper" style="margin-bottom: 10px;">
                <?php if ( $logo_url ) : ?>
                    <img id="logo-preview" class="media-preview" src="<?php echo esc_url( $logo_url ); ?>" style="max-width: 200px; height: auto;">
                <?php else : ?>
                    <img id="logo-preview" class="media-preview" src="" style="max-width: 200px; height: auto; display: none;">
                <?php endif; ?>
            </div>
            <input type="button" class="button button-secondary upload-media-button" data-input="#custom_logo" data-preview="#logo-preview" value="<?php esc_attr_e( 'Upload Logo', 'archie-rombo' ); ?>">
            <input type="button" class="button button-secondary remove-media-button" data-input="#custom_logo" data-preview="#logo-preview" value="<?php esc_attr_e( 'Remove Logo', 'archie-rombo' ); ?>" <?php echo $logo_url ? '' : 'style="display: none;"'; ?>>
            <p class="description"><?php esc_html_e( 'Upload a custom logo for your site header.', 'archie-rombo' ); ?></p>
        </td>
    </tr>
    <?php
}

/**
 * Render the options page HTML (General Info).
 */
function archie_rombo_render_options_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'General Settings', 'archie-rombo' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'archie_rombo_options_group' ); ?>
            <table class="form-table">
                <?php archie_rombo_render_logo_field(); ?>
                
                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Contact Information', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Phone Number', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="theme_phone_number" value="<?php echo esc_attr( get_option( 'theme_phone_number' ) ); ?>" class="regular-text" placeholder="+254-123-456-789" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Email Address', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="email" name="theme_email" value="<?php echo esc_attr( get_option( 'theme_email' ) ); ?>" class="regular-text" placeholder="info@example.com" />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Header Behavior', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Sticky Navbar', 'archie-rombo' ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="archie_rombo_fixed_header" value="1" <?php checked( 1, get_option( 'archie_rombo_fixed_header' ), true ); ?> />
                            <?php esc_html_e( 'Enable Sticky Navbar', 'archie-rombo' ); ?>
                        </label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Transparent Header', 'archie-rombo' ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="archie_rombo_transparent_header" value="1" <?php checked( 1, get_option( 'archie_rombo_transparent_header' ), true ); ?> />
                            <?php esc_html_e( 'Enable Transparent Header on Homepage', 'archie-rombo' ); ?>
                        </label>
                        <p class="description"><?php esc_html_e( 'When enabled, the header will be transparent and overlay the hero section on the homepage.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Navbar Height (px)', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="number" name="archie_rombo_navbar_height" value="<?php echo esc_attr( get_option( 'archie_rombo_navbar_height', 80 ) ); ?>" class="small-text" />
                        <p class="description"><?php esc_html_e( 'Set the height for the main navigation bar. Default is 80px.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Navbar Shrink on Scroll', 'archie-rombo' ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="archie_rombo_navbar_shrink" value="1" <?php checked( 1, get_option( 'archie_rombo_navbar_shrink', 0 ), true ); ?> />
                            <?php esc_html_e( 'Enable Shrink on Scroll', 'archie-rombo' ); ?>
                        </label>
                        <p class="description"><?php esc_html_e( 'If enabled, the sticky navbar will shrink in height when you scroll down.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Mobile Top Bar', 'archie-rombo' ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="archie_rombo_mobile_topbar_hide" value="1" <?php checked( 1, get_option( 'archie_rombo_mobile_topbar_hide', 0 ), true ); ?> />
                            <?php esc_html_e( 'Hide Top Bar on Mobile Devices', 'archie-rombo' ); ?>
                        </label>
                        <p class="description"><?php esc_html_e( 'Hide the phone/email/login bar on mobile screens for a cleaner look.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Navigation Behavior', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Back to Top Button', 'archie-rombo' ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="archie_rombo_back_to_top" value="1" <?php checked( 1, get_option( 'archie_rombo_back_to_top', 1 ), true ); ?> />
                            <?php esc_html_e( 'Enable Back to Top button', 'archie-rombo' ); ?>
                        </label>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Render Typography Page.
 */
function archie_rombo_render_typography_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Typography Settings', 'archie-rombo' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'archie_rombo_options_group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Body Font Size (px)', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="number" name="archie_rombo_body_font_size" value="<?php echo esc_attr( get_option( 'archie_rombo_body_font_size', 17 ) ); ?>" class="small-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Main Heading Font Size (px)', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="number" name="archie_rombo_heading_font_size" value="<?php echo esc_attr( get_option( 'archie_rombo_heading_font_size', 36 ) ); ?>" class="small-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Body Font Family', 'archie-rombo' ); ?></th>
                    <td>
                        <select name="archie_rombo_body_font_family">
                            <?php 
                            $body_font = get_option( 'archie_rombo_body_font_family', 'TitilliumWeb' );
                            $fonts = array(
                                'TitilliumWeb' => 'Titillium Web (Sans-Serif)',
                                'Amaranth'     => 'Amaranth (Cursive-style Sans)',
                                'Roboto'       => 'Roboto (Standard Sans)',
                                'Arial'        => 'Arial (System)',
                                'Georgia'      => 'Georgia (Serif)'
                            );
                            foreach ($fonts as $val => $label) {
                                printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($body_font, $val, false), esc_html($label));
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Heading Font Family', 'archie-rombo' ); ?></th>
                    <td>
                        <select name="archie_rombo_heading_font_family">
                            <?php 
                            $heading_font = get_option( 'archie_rombo_heading_font_family', 'Amaranth' );
                            foreach ($fonts as $val => $label) {
                                printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($heading_font, $val, false), esc_html($label));
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Body Line Height', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_body_line_height" value="<?php echo esc_attr( get_option( 'archie_rombo_body_line_height', '1.75' ) ); ?>" class="small-text" placeholder="1.75" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Heading Line Height', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_heading_line_height" value="<?php echo esc_attr( get_option( 'archie_rombo_heading_line_height', '1.4' ) ); ?>" class="small-text" placeholder="1.4" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Body Font Weight', 'archie-rombo' ); ?></th>
                    <td>
                        <select name="archie_rombo_body_font_weight">
                            <?php 
                            $weight = get_option( 'archie_rombo_body_font_weight', 'normal' );
                            $weights = array('300' => 'Light', 'normal' => 'Normal', '600' => 'Semi-Bold', 'bold' => 'Bold');
                            foreach ($weights as $val => $label) {
                                printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($weight, $val, false), esc_html($label));
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Heading Font Weight', 'archie-rombo' ); ?></th>
                    <td>
                        <select name="archie_rombo_heading_font_weight">
                            <?php 
                            $h_weight = get_option( 'archie_rombo_heading_font_weight', 'bold' );
                            foreach ($weights as $val => $label) {
                                printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($h_weight, $val, false), esc_html($label));
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Heading Text Transform', 'archie-rombo' ); ?></th>
                    <td>
                        <select name="archie_rombo_heading_transform">
                            <?php 
                            $transform = get_option( 'archie_rombo_heading_transform', 'none' );
                            $transforms = array('none' => 'None', 'uppercase' => 'UPPERCASE', 'capitalize' => 'Capitalize', 'lowercase' => 'lowercase');
                            foreach ($transforms as $val => $label) {
                                printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($transform, $val, false), esc_html($label));
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Body Letter Spacing (px)', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_body_letter_spacing" value="<?php echo esc_attr( get_option( 'archie_rombo_body_letter_spacing', '0' ) ); ?>" class="small-text" placeholder="0" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Heading Letter Spacing (px)', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_heading_letter_spacing" value="<?php echo esc_attr( get_option( 'archie_rombo_heading_letter_spacing', '0' ) ); ?>" class="small-text" placeholder="0" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Render Appearance Page.
 */
function archie_rombo_render_appearance_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Appearance & Hero', 'archie-rombo' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'archie_rombo_options_group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Theme Colors', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Primary Theme Color', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_primary_color" value="<?php echo esc_attr( get_option( 'archie_rombo_primary_color', '#33bbcc' ) ); ?>" class="my-color-field" data-default-color="#33bbcc" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Heading Text Color', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_heading_color" value="<?php echo esc_attr( get_option( 'archie_rombo_heading_color', '' ) ); ?>" class="my-color-field" data-default-color="" />
                        <p class="description"><?php esc_html_e( 'Leave empty to use theme defaults.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Button Styling', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Button Border Radius (px)', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="number" name="archie_rombo_button_radius" value="<?php echo esc_attr( get_option( 'archie_rombo_button_radius', 4 ) ); ?>" class="small-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Button Vertical Padding (px)', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="number" name="archie_rombo_button_padding_v" value="<?php echo esc_attr( get_option( 'archie_rombo_button_padding_v', 10 ) ); ?>" class="small-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Button Horizontal Padding (px)', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="number" name="archie_rombo_button_padding_h" value="<?php echo esc_attr( get_option( 'archie_rombo_button_padding_h', 20 ) ); ?>" class="small-text" />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Hero Section', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Default Hero Background', 'archie-rombo' ); ?></th>
                    <td>
                        <?php
                        $header_bg_id = get_option( 'archie_rombo_header_bg' );
                        $header_bg_url = $header_bg_id ? wp_get_attachment_image_url( $header_bg_id, 'full' ) : '';
                        ?>
                        <input type="hidden" id="archie_rombo_header_bg" name="archie_rombo_header_bg" value="<?php echo esc_attr( $header_bg_id ); ?>">
                        <div style="margin-bottom: 10px;">
                            <img id="header-bg-preview" class="media-preview" src="<?php echo esc_url( $header_bg_url ); ?>" style="max-width: 300px; height: auto; <?php echo $header_bg_url ? '' : 'display: none;'; ?>">
                        </div>
                        <input type="button" class="button button-secondary upload-media-button" data-input="#archie_rombo_header_bg" data-preview="#header-bg-preview" value="<?php esc_attr_e( 'Upload Background', 'archie-rombo' ); ?>">
                        <input type="button" class="button button-secondary remove-media-button" data-input="#archie_rombo_header_bg" data-preview="#header-bg-preview" value="<?php esc_attr_e( 'Remove Background', 'archie-rombo' ); ?>" <?php echo $header_bg_url ? '' : 'style="display: none;"'; ?>>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Hero Overlay Color', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_header_overlay_color" value="<?php echo esc_attr( get_option( 'archie_rombo_header_overlay_color', '#000000' ) ); ?>" class="my-color-field" data-default-color="#000000" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Hero Overlay Opacity', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_header_overlay_opacity" value="<?php echo esc_attr( get_option( 'archie_rombo_header_overlay_opacity', '0.5' ) ); ?>" class="small-text" placeholder="0.5" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Hero Vertical Padding (px)', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="number" name="archie_rombo_hero_padding" value="<?php echo esc_attr( get_option( 'archie_rombo_hero_padding', 100 ) ); ?>" class="small-text" />
                        <p class="description"><?php esc_html_e( 'Set the top/bottom padding for the hero section. Default is 100px.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Layout Settings', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Sidebar Position', 'archie-rombo' ); ?></th>
                    <td>
                        <select name="archie_rombo_sidebar_position">
                            <?php 
                            $sidebar_pos = get_option( 'archie_rombo_sidebar_position', 'right' );
                            $positions = array(
                                'right' => 'Right Sidebar',
                                'left'  => 'Left Sidebar',
                                'none'  => 'No Sidebar (Full Width)'
                            );
                            foreach ($positions as $val => $label) {
                                printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($sidebar_pos, $val, false), esc_html($label));
                            }
                            ?>
                        </select>
                        <p class="description"><?php esc_html_e( 'Choose the default sidebar layout for posts and pages.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Main Container Width', 'archie-rombo' ); ?></th>
                    <td>
                        <select name="archie_rombo_container_width">
                            <?php 
                            $container_width = get_option( 'archie_rombo_container_width', 'fluid' );
                            $widths = array(
                                'fluid' => 'Full Width (Edge to Edge)',
                                'boxed' => 'Boxed (Centered Content)'
                            );
                            foreach ($widths as $val => $label) {
                                printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($container_width, $val, false), esc_html($label));
                            }
                            ?>
                        </select>
                        <p class="description"><?php esc_html_e( 'Choose between a full-width layout or a standard boxed container for the main content area.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Sidebar Width', 'archie-rombo' ); ?></th>
                    <td>
                        <select name="archie_rombo_sidebar_width">
                            <?php 
                            $sidebar_width = get_option( 'archie_rombo_sidebar_width', '3' );
                            $s_widths = array(
                                '2' => 'Narrow (2/12 Columns)',
                                '3' => 'Standard (3/12 Columns)',
                                '4' => 'Wide (4/12 Columns)'
                            );
                            foreach ($s_widths as $val => $label) {
                                printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($sidebar_width, $val, false), esc_html($label));
                            }
                            ?>
                        </select>
                        <p class="description"><?php esc_html_e( 'Choose the width of the sidebar relative to the content.', 'archie-rombo' ); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Render Social Media Page.
 */
function archie_rombo_render_social_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Content & Social', 'archie-rombo' ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'archie_rombo_options_group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Blog Settings', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Read More Text', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_read_more_text" value="<?php echo esc_attr( get_option( 'archie_rombo_read_more_text', 'Read More' ) ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Footer Copyright', 'archie-rombo' ); ?></th>
                    <td>
                        <textarea name="archie_rombo_footer_copyright" rows="3" class="large-text"><?php echo esc_textarea( get_option( 'archie_rombo_footer_copyright', '&copy; ' . date('Y') . ' Archie Rombo' ) ); ?></textarea>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Social Media Styling', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Icon Style', 'archie-rombo' ); ?></th>
                    <td>
                        <select name="archie_rombo_social_icon_style">
                            <?php 
                            $icon_style = get_option( 'archie_rombo_social_icon_style', 'none' );
                            $styles = array('none' => 'Icon Only', 'square' => 'Square Background', 'round' => 'Round Background');
                            foreach ($styles as $val => $label) {
                                printf('<option value="%s" %s>%s</option>', esc_attr($val), selected($icon_style, $val, false), esc_html($label));
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Icon Custom Color', 'archie-rombo' ); ?></th>
                    <td>
                        <input type="text" name="archie_rombo_social_icon_color" value="<?php echo esc_attr( get_option( 'archie_rombo_social_icon_color', '' ) ); ?>" class="my-color-field" data-default-color="" />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row" colspan="2"><h2><?php esc_html_e( 'Social Media Links', 'archie-rombo' ); ?></h2></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Facebook URL', 'archie-rombo' ); ?></th>
                    <td><input type="url" name="archie_rombo_facebook_url" value="<?php echo esc_attr( get_option( 'archie_rombo_facebook_url' ) ); ?>" class="regular-text" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Twitter URL', 'archie-rombo' ); ?></th>
                    <td><input type="url" name="archie_rombo_twitter_url" value="<?php echo esc_attr( get_option( 'archie_rombo_twitter_url' ) ); ?>" class="regular-text" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Instagram URL', 'archie-rombo' ); ?></th>
                    <td><input type="url" name="archie_rombo_instagram_url" value="<?php echo esc_attr( get_option( 'archie_rombo_instagram_url' ) ); ?>" class="regular-text" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'LinkedIn URL', 'archie-rombo' ); ?></th>
                    <td><input type="url" name="archie_rombo_linkedin_url" value="<?php echo esc_attr( get_option( 'archie_rombo_linkedin_url' ) ); ?>" class="regular-text" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Enqueue scripts and styles for the dashboard.
 */
function archie_rombo_admin_scripts( $hook ) {
    $allowed_hooks = array(
        'toplevel_page_archie_rombo_dashboard',
        'archie-rombo_page_archie_rombo_typography',
        'archie-rombo_page_archie_rombo_appearance',
        'archie-rombo_page_archie_rombo_social',
        'archie-rombo_page_archie_rombo_docs',
        'archie-rombo_page_archie_rombo_support'
    );

    if ( ! in_array( $hook, $allowed_hooks ) ) {
        return;
    }

    // Media Uploader
    wp_enqueue_media();

    // Color Picker
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'archie-rombo-admin-js', get_template_directory_uri() . '/js/admin.js', array( 'wp-color-picker' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'archie_rombo_admin_scripts' );

/**
 * Render Documentation Page
 */
function archie_rombo_render_docs_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Theme Documentation', 'archie-rombo' ); ?></h1>
        <div class="card" style="max-width: 800px; padding: 20px; margin-top: 20px;">
            <h2>Getting Started</h2>
            <p>Welcome to the <strong>Archie Rombo</strong> theme! This theme is designed to be modern, responsive, and highly customizable.</p>
            
            <h3>Typography Settings</h3>
            <p>You can adjust font sizes, families, and weights in the <a href="<?php echo admin_url('admin.php?page=archie_rombo_dashboard'); ?>">Dashboard</a>. We support several Google Font stacks out of the box.</p>
            
            <h3>Hero Section</h3>
            <p>The hero section appears on pages and archives. You can upload a default background image and set an overlay transparency to ensure your titles are always readable.</p>
            
            <h3>Need More Help?</h3>
            <p>Check the Support tab for direct contact information.</p>
        </div>
    </div>
    <?php
}

/**
 * Render Support Page
 */
function archie_rombo_render_support_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Theme Support', 'archie-rombo' ); ?></h1>
        <div class="card" style="max-width: 800px; padding: 20px; margin-top: 20px;">
            <h2>Need Assistance?</h2>
            <p>If you're experiencing issues or have questions about theme customization, we're here to help.</p>
            
            <ul style="list-style: disc; margin-left: 20px;">
                <li><strong>Email:</strong> support@archierombo.com</li>
                <li><strong>Forum:</strong> <a href="#" target="_blank">Community Support Forum</a></li>
                <li><strong>Hours:</strong> Mon - Fri, 9am - 5pm EST</li>
            </ul>
            
            <hr>
            <h3>Quick Troubleshooting</h3>
            <p>If settings aren't appearing, try clearing your browser cache or any WordPress caching plugins you may have active.</p>
        </div>
    </div>
    <?php
}
add_action( 'admin_enqueue_scripts', 'archie_rombo_admin_scripts' );
