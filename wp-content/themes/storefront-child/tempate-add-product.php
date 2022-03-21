<?php
/**
 * Template Name: Add product
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<h1>Create new product</h1>
        <? 
        
        get_template_part( 'content', 'form_add' );

        ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
