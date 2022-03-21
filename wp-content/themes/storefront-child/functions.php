<?php 
// Require create product form action
require_once get_stylesheet_directory() . '/create-product-form-action.php';

// Require custom admin scripts and styles
add_action( 'admin_enqueue_scripts', 'custom_admin_scripts' );
function custom_admin_scripts( $hook ) {
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
    wp_enqueue_style('custom-admin-styles', get_stylesheet_directory_uri().'/assets/css/admin-custom.css');
 	wp_enqueue_script( 'custom-admin-js', get_stylesheet_directory_uri() . '/assets/js/admin-custom.js', array('jquery'), null, false );
}

// Require custom scripts
add_action( 'wp_enqueue_scripts', 'custom_scripts' );
function custom_scripts() {
    wp_enqueue_script( 'jquery-form' );

    wp_enqueue_script( 'ajax-form', get_theme_file_uri( '/assets/js/ajax-form.js' ), array('jquery'), 1.0, true );
    wp_localize_script( 'ajax-form', 'ajax_form_object', array(
    'url'   => admin_url( 'admin-ajax.php' ),
    'nonce' => wp_create_nonce( 'ajax-form-nonce' ),
    ) );

    wp_enqueue_script( 'customjs', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), null, false );
}

// Custom image field 
function image_uploader_field( $args ) {
	$value = $args[ 'value' ];
	$default = '/wp-content/uploads/woocommerce-placeholder.png';
 
	if( $value && ( $image_attributes = wp_get_attachment_image_src( $value, array( 150, 110 ) ) ) ) {
		$src = $image_attributes[0];
	} else {
		$src = $default;
	}
	echo '
        <p class="form-field custom_picture_field ">
            <label>Custom image</label>
		    <img class="custom-upload-img" data-default="'.$default.'" src="'.$src.'" width="150" />
			<input class="custom-upload-input" type="hidden" name="'.$args[ 'name' ].'" id="'.$args[ 'name' ].'" value="'.$value.'" />
			<button type="submit" class="custom-upload-button button">Upload</button>
			<button type="submit" class="custom-upload-remove-button button">Delete</button>
		</p>
	';
}

// Add custom fields to woo panel
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_fields' );
function woo_add_custom_fields() {
	global $product, $post;

	echo '<div class="options_group">'; 
        // Custom image upload field 
        if( function_exists( 'image_uploader_field' ) ) {
            image_uploader_field( array(
                'name' => 'custom_picture',
                'value' => get_post_meta( $post->ID, 'custom_picture', true ),
            ) );
        }

        // Woo custom select "Type" field
        woocommerce_wp_select( array(
            'id'      => 'select_type',
            'label'   => 'Type',
            'options' => array(
            ' '       => __(' ', 'woocommerce'),
            'rare'   => __( 'Rare', 'woocommerce' ),
            'frequent'   => __( 'Frequent', 'woocommerce' ),
            'unusual' => __( 'Unusual', 'woocommerce' ),
            ),
        ) );

        // Custom date field
        $date_input = '<p class="form-field create_date_field ">
                            <label for="create_date">Create date:</label>
                            <input type="date" id="create_date" name="create_date" value="'.esc_attr( get_post_meta( $post->ID, 'create_date', true ) ).'">
                        </p>';
        echo $date_input;
	echo '</div>';
}

// Save custom fields
add_action( 'woocommerce_process_product_meta', 'woo_custom_fields_save', 10 );
function woo_custom_fields_save( $post_id ) {
    $woo_my_picture = $_POST['custom_picture'];
	if ( ! empty( $woo_my_picture ) ) {
		update_post_meta( $post_id, 'custom_picture', $woo_my_picture );
	} else {
        delete_post_meta( $post_id, 'custom_picture', $woo_my_picture );
    }

	$woo_select_type = $_POST['select_type'];
	if ( ! empty( $woo_select_type ) ) {
		update_post_meta( $post_id, 'select_type', esc_attr( $woo_select_type ) );
	} else {
        delete_post_meta( $post_id, 'select_type', $woo_select_type );
    }

    $woo_create_date = $_POST['create_date'];
	if ( ! empty( $woo_create_date ) ) {
		update_post_meta( $post_id, 'create_date', esc_attr( $woo_create_date ) );
	} else {
        delete_post_meta( $post_id, 'create_date', $woo_create_date );
    }
}