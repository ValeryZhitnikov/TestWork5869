<?php
/** 
 * New product form action 
 */
add_action( 'wp_ajax_ajax_form_action', 'ajax_action_callback' );
add_action( 'wp_ajax_nopriv_ajax_form_action', 'ajax_action_callback' );

function ajax_action_callback() {

    $postTitle = $_POST['post_title'];
    $price = $_POST['price'];
    $custom_picture  = $_POST['custom_picture'];
    $select_type = $_POST['select_type'];
    $create_date = $_POST['create_date'];
    $submit = $_POST['submit'];

    if( isset($submit) ) {

        global $user_ID;

        $post = array(
            'post_author' => $user_ID,
            'post_content' => '',
            'post_status' => "publish",
            'post_title' => $postTitle,
            'post_type' => "product",
        );

        // Create new product
        $post_id = wp_insert_post($post);

        // Custom image upload
        if (
            isset( $_POST['custom_picture_nonce'], $post_id )
            && wp_verify_nonce( $_POST['custom_picture_nonce'], 'custom_picture' )
        ) {

            $attachment_id = media_handle_upload( 'custom_picture', $post_id );
            if ( is_wp_error( $attachment_id ) ) {
                $error_string = $attachment_id->get_error_message();
                echo '<div class="error-message">File uploading error - '. $error_string .'</div>';
            } else {
                set_post_thumbnail($post_id, $attachment_id);	
                update_post_meta( $post_id, 'custom_picture', $attachment_id );
            }

        } else {
            echo '<div class="error-message">File uploading error</div>';
        }

        // Set new product params
        update_post_meta( $post_id, '_visibility', 'visible' );
        update_post_meta( $post_id, '_downloadable', 'no');
        update_post_meta( $post_id, '_virtual', 'no');
        wp_set_object_terms($post_id, "simple", 'product_type');		
        update_post_meta( $post_id, '_price', $price);
        if ($select_type) {
            update_post_meta( $post_id, 'select_type', esc_attr( $select_type ) );
        }
        if ($create_date) {
            update_post_meta( $post_id, 'create_date', esc_attr( $create_date ) );
        }
        
        // Send succes message
        $message_success = '<div class="succes-message">Product has been created</div>';
        wp_send_json_success( $message_success );

    }

    wp_die();
}