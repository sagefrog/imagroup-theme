<?php

$postId = get_the_id();

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$content = get_sub_field( 'contact_us_heading_content' );
    
    $general_inquiry_button = get_sub_field( 'contact_us_general_inquiry_button' );
    $general_inquiry_image = get_sub_field( 'contact_us_general_inquiry_image' );
    $contact_form = get_sub_field( 'contact_us_general_inquiry_contact_form' );
    $success_message = get_sub_field( 'contact_us_general_inquiry_success_message' );

    $partner_button = get_sub_field( 'contact_us_partner_with_us_button' );
    $partner_image = get_sub_field( 'contact_us_partner_with_us_image' );
    $partner_contact_form = get_sub_field( 'contact_us_partner_with_us_contact_form' );
    $partner_success_message = get_sub_field( 'contact_us_partner_with_us_success_message' );    ?>

    <section <?php imagroup_section_id($id); ?> class="contact-banner pt-md-90 pb-xl-150 pb-md-125 pb-100 pt-60 banner-bg <?php echo esc_attr($extra_class); ?>" data-background="<?php echo IMAGE_ASSETS_URL; ?>/contact-banner.png">
        <div class="contact-banner-mobile banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/contact-banner-mobile.png"></div>
        <div class="container"><?php
            if( !empty($content) ){ ?>
                <div class="content-title body-xl text-center max-width-675 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <?php echo imagroup_remove_empty_p( wpautop($content) ); ?>
                </div><?php
            }

            $action = '';
            if( isset($_GET['action']) && !empty($_GET['action']) ){
                $action = $_GET['action'];
            }

            if( $action == 'partner-with-us-form' ){ ?>
                <div class="contact-top-line wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <span class="d-md-block d-none"><img src="<?php echo IMAGE_ASSETS_URL; ?>/contact-arrow-line.svg" alt="contact-line"></span>
					<span class="d-md-none d-block"><img src="<?php echo IMAGE_ASSETS_URL; ?>/blue-arrow-circle-down.svg" alt="blue-arrow-circle-down"></span>
                </div>
                <div class="contact-form-row">
                    <div class="contact-form-title partner" style="background-color:#6ABF4B;">
                        <p><?php echo esc_html__( 'PARTNER WITH US', 'imagroup' ); ?></p>
                        <a href="<?php echo get_the_permalink($postId); ?>" class="form-close"><img src="<?php echo IMAGE_ASSETS_URL; ?>/times-white.svg" alt="times-white"></a>
                    </div>
                    <div class="contact-form">
                        <?php echo do_shortcode($partner_contact_form); ?>
                    </div>
                </div><?php
            } else if( $action == 'general-inquiry-form' ){ ?>
                <div class="contact-top-line wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <span class="d-md-block d-none"><img src="<?php echo IMAGE_ASSETS_URL; ?>/contact-arrow-line.svg" alt="contact-line"></span>
					<span class="d-md-none d-block"><img src="<?php echo IMAGE_ASSETS_URL; ?>/blue-arrow-circle-down.svg" alt="blue-arrow-circle-down"></span>
                </div>
                <div class="contact-form-row">
                    <div class="contact-form-title">
                        <p><?php echo esc_html__( 'GENERAL INQUIRY', 'imagroup' ); ?></p>
                        <a href="<?php echo get_the_permalink($postId); ?>" class="form-close"><img src="<?php echo IMAGE_ASSETS_URL; ?>/times-white.svg" alt="times-white"></a>
                    </div>
                    <div class="contact-form">
                        <?php echo do_shortcode($contact_form); ?>
                    </div>
                </div><?php
            } else { ?>
                <div class="contact-top-line wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <span class="d-md-block d-none"><img src="<?php echo IMAGE_ASSETS_URL; ?>/contact-line.svg" alt="contact-line"></span>
                    <span class="d-md-none d-block"><img src="<?php echo IMAGE_ASSETS_URL; ?>/blue-arrow-circle-down.svg" alt="blue-arrow-circle-down"></span>
                </div>
                <div class="contact-blog-row">
                    <div class="row gx-xl-40 gx-lg-30 gx-md-40 gy-30"><?php
                        if( !empty($general_inquiry_button) || !empty($general_inquiry_image) ){ ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php
                                $button_attr = imagroup_acf_link( $general_inquiry_button, 'contact-blog wow fadeInUp' );
                                if( $button_attr['status'] ){ ?>
                                    <a <?php echo $button_attr['attributes']; ?> data-wow-delay="0.3s" data-wow-duration="0.5s">
                                        <span class="btn btn-primary btn-text-primary"><?php echo $button_attr['title']; ?></span><?php
                                        if( !empty($general_inquiry_image) ){ ?>
                                            <div class="contact-blog-img">
                                                <img src="<?php echo esc_url($general_inquiry_image['url']); ?>" alt="<?php echo esc_attr($general_inquiry_image['alt']); ?>">
                                            </div><?php
                                        } ?>
                                    </a><?php
                                } ?>
                            </div><?php
                        } ?>
                        
                        <div class="col-12 d-md-none d-block">
                            <span class="d-md-none text-center d-block"><img src="<?php echo IMAGE_ASSETS_URL; ?>/blue-arrow-circle-down.svg" alt="blue-arrow-circle-down"></span>
                        </div><?php

                        if( !empty($partner_button) || !empty($partner_image) ){ ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12"><?php
                                $button_attr = imagroup_acf_link( $partner_button, 'contact-blog wow fadeInUp' );
                                if( $button_attr['status'] ){ ?>
                                    <a <?php echo $button_attr['attributes']; ?> data-wow-delay="0.3s" data-wow-duration="0.5s">
                                        <span class="btn btn-parrot"><?php echo $button_attr['title']; ?></span><?php
                                        if( !empty($partner_image) ){ ?>
                                            <div class="contact-blog-img">
                                                <img src="<?php echo esc_url($partner_image['url']); ?>" alt="<?php echo esc_attr($partner_image['alt']); ?>">
                                            </div><?php
                                        } ?>
                                    </a><?php
                                } ?>
                            </div><?php
                        } ?>
                    </div>
                </div><?php
            } ?>
        </div><?php

        if( $action == 'general-inquiry-form' || $action == 'partner-with-us-form' ){ ?>
            <div class="bottom-blue-bar"></div><?php
        }
        
        if( $action == 'general-inquiry-success' ){
            
            ?>
            
            <div class="modal success-modal fade" id="general-inquiry-success" tabindex="-1" aria-labelledby="general-inquiry-successLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="<?php echo IMAGE_ASSETS_URL; ?>/close-orange.svg" alt="close-orange"></button>
                        </div>
                        <div class="modal-body">
                            <?php echo wpautop($success_message); ?>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                jQuery(document).ready(function() {
                    jQuery('#general-inquiry-success').modal('show');
                });
            </script><?php

                
            
        
        } else if( $action == 'partner-with-us-success' ){
             ?>
            
            <div class="modal success-modal fade" id="general-inquiry-success" tabindex="-1" aria-labelledby="general-inquiry-successLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="<?php echo IMAGE_ASSETS_URL; ?>/close-orange.svg" alt="close-orange"></button>
                        </div>
                        <div class="modal-body">
                            <?php echo wpautop($partner_success_message); ?>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                jQuery(document).ready(function() {
                    jQuery('#general-inquiry-success').modal('show');
                });
            </script><?php

        } ?>
    </section><?php
}

?>