<?php

get_header();

$error_title = imagroup_theme_option( 'error_title' );
$error_sub_title = imagroup_theme_option( 'error_sub_title' );
$error_content = imagroup_theme_option( 'error_content' );
$error_home_label = imagroup_theme_option( 'error_home_label' );

?>
<section class="error-page">
    <div class="container text-center">
        <div class="error-title">
            <h1><?php echo $error_title; ?></h1>
        </div>
        <div class="error-sub-title">
            <h2><?php echo $error_sub_title; ?></h2>
        </div>
        <div class="error-content">
            <?php echo apply_filters( 'the_content', imagroup_remove_empty_p( $error_content ) ); ?>
        </div>
        <div class="error-button">
        	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="main-btn"><span><?php echo $error_home_label; ?></span></a>
        </div>
    </div>
</section><?php

get_footer();

?>