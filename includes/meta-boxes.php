<?php
/**
 * Theme Meta Boxes
 *
 * @package Archie_Rombo
 */

/**
 * Add Sidebar Layout Meta Box to Posts and Pages.
 */
function archie_rombo_add_sidebar_meta_box() {
    $screens = array( 'post', 'page' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'archie_rombo_sidebar_layout',           // Unique ID
            __( 'Sidebar Layout', 'archie-rombo' ),  // Box title
            'archie_rombo_sidebar_meta_box_html',    // Content callback
            $screen,                                // Post type
            'side'                                  // Context
        );
    }
}
add_action( 'add_meta_boxes', 'archie_rombo_add_sidebar_meta_box' );

/**
 * Render Meta Box HTML.
 */
function archie_rombo_sidebar_meta_box_html( $post ) {
    $value = get_post_meta( $post->ID, '_archie_rombo_sidebar_layout', true );
    if ( ! $value ) {
        $value = 'default';
    }
    
    // Add nonce for security
    wp_nonce_field( 'archie_rombo_sidebar_nonce', 'archie_rombo_sidebar_nonce_field' );
    ?>
    <label for="archie_rombo_sidebar_layout_field"><?php esc_html_e( 'Choose sidebar position for this item:', 'archie-rombo' ); ?></label>
    <select name="archie_rombo_sidebar_layout_field" id="archie_rombo_sidebar_layout_field" class="postbox">
        <option value="default" <?php selected( $value, 'default' ); ?>><?php esc_html_e( 'Global Default', 'archie-rombo' ); ?></option>
        <option value="right" <?php selected( $value, 'right' ); ?>><?php esc_html_e( 'Right Sidebar', 'archie-rombo' ); ?></option>
        <option value="left" <?php selected( $value, 'left' ); ?>><?php esc_html_e( 'Left Sidebar', 'archie-rombo' ); ?></option>
        <option value="none" <?php selected( $value, 'none' ); ?>><?php esc_html_e( 'No Sidebar (Full Width)', 'archie-rombo' ); ?></option>
    </select>
    <p class="description"><?php esc_html_e( 'Overrides the global sidebar setting.', 'archie-rombo' ); ?></p>
    <?php
}

/**
 * Save Meta Box data.
 */
function archie_rombo_save_sidebar_meta_box_data( $post_id ) {
    // Verify nonce
    if ( ! isset( $_POST['archie_rombo_sidebar_nonce_field'] ) || 
         ! wp_verify_nonce( $_POST['archie_rombo_sidebar_nonce_field'], 'archie_rombo_sidebar_nonce' ) ) {
        return;
    }

    // Check user capabilities
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( array_key_exists( 'archie_rombo_sidebar_layout_field', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_archie_rombo_sidebar_layout',
            sanitize_text_field( $_POST['archie_rombo_sidebar_layout_field'] )
        );
    }
}
add_action( 'save_post', 'archie_rombo_save_sidebar_meta_box_data' );
