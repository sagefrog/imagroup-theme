<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$layout = get_sub_field( 'content_image_layout' );
    $image = get_sub_field( 'content_image_image' );
    $heading_content = get_sub_field( 'content_image_heading_content' );
    $button = get_sub_field( 'content_image_button' );
    
    if( $layout == 6 ){ ?>
        <section <?php imagroup_section_id($id); ?> class="content-part bg-blue pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pt-100 pb-100 <?php echo esc_attr($extra_class); ?>">
            <div class="green-round-vektor banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/verktor4.svg">
                <div class="green-round-vektor-mobile banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/vektor-4-mobile.svg"></div>
                <img src="<?php echo IMAGE_ASSETS_URL; ?>/vektor3.svg" alt="vektor3" class="desktop-img">
                <img src="<?php echo IMAGE_ASSETS_URL; ?>/vektor-3-mobile.svg" alt="vektor-3-mobile" class="mobile-img">
            </div>
            <div class="container">
                <div class="content-row">
                    <div class="row align-items-center gx-xxl-70 gx-xl-50 gy-md-30 gy-sm-30">
                        <div class="col-lg-6 col-md-6 order-md-first order-last col-sm-12 col-12">
                            <div class="content-title blue-title max-width-560 ml-auto wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                if( !empty($heading_content) ){
                                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                                }

                                $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-secondary btn-text-secondary' );
                                if( $button_attr['status'] ){ ?>
                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                } ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 order-md-last order-first col-sm-12 col-12"><?php
                            if( !empty($image) ){ ?>
                                <div class="content-img wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"></div><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    } else if( $layout == 5 ){ ?>
        <section <?php imagroup_section_id($id); ?> class="content-part overflow-hidden pt-xl-75 pb-xl-75 pt-md-65 pb-md-65 pb-35 pt-35 <?php echo esc_attr($extra_class); ?>">
            <div class="container">
                <div class="content-row">
                    <div class="row align-items-center gx-xxl-70 gx-xl-50 gy-md-30 gy-sm-30">
                        <div class="col-lg-6 order-md-first order-last col-md-6 col-sm-12 col-12">
                            <div class="content-title max-width-560 mr-auto wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                if( !empty($heading_content) ){
                                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                                }

                                $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-secondary' );
                                if( $button_attr['status'] ){ ?>
                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                } ?>
                            </div>
                        </div>
                        <div class="col-lg-6 order-md-last order-first col-md-6 col-sm-12 col-12"><?php
                            if( !empty($image) ){ ?>
                                <div class="content-img wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"><span class="blue-circle-bottom-left-small"></span></div><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    } else if( $layout == 4 ){ ?>
        <section <?php imagroup_section_id($id); ?> class="content-part overflow-hidden pt-xl-75 pb-xl-75 pt-md-65 pb-md-65 pb-35 pt-35 <?php echo esc_attr($extra_class); ?>">
            <div class="container">
                <div class="content-row">
                    <div class="row align-items-center gx-xxl-70 gx-xl-50 gy-md-30 gy-sm-30">
                        <div class="col-lg-6 order-md-first order-last col-md-6 col-sm-12 col-12">
                            <div class="content-title max-width-560 mr-auto wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                if( !empty($heading_content) ){
                                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                                }

                                $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-secondary' );
                                if( $button_attr['status'] ){ ?>
                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                } ?>
                            </div>
                        </div>
                        <div class="col-lg-6 order-md-last order-first col-md-6 col-sm-12 col-12"><?php
                            if( !empty($image) ){ ?>
                                <div class="content-img wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"><span class="green-circle-top-left-small"></span></div><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    } else if( $layout == 3 ){ ?>
        <section <?php imagroup_section_id($id); ?> class="content-part overflow-hidden pt-xl-75 pb-xl-75 pt-md-65 pb-md-65 pb-35 pt-35 <?php echo esc_attr($extra_class); ?>">
            <div class="container">
                <div class="content-row">
                    <div class="row align-items-center gx-xxl-70 gx-xl-50 gy-md-30 gy-sm-30">
                        <div class="col-lg-6 order-md-first order-last col-md-6 col-sm-12 col-12">
                            <div class="content-title max-width-560 mr-auto wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                if( !empty($heading_content) ){
                                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                                }

                                $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-secondary' );
                                if( $button_attr['status'] ){ ?>
                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                } ?>
                            </div>
                        </div>
                        <div class="col-lg-6 order-md-last order-first col-md-6 col-sm-12 col-12"><?php
                            if( !empty($image) ){ ?>
                                <div class="content-img wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"><span class="green-circle-bottom-right"></span></div><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    } else if( $layout == 2 ){ ?>
        <section <?php imagroup_section_id($id); ?> class="content-part overflow-hidden pt-xl-75 pb-xl-75 pt-md-65 pb-md-65 pb-35 pt-35 <?php echo esc_attr($extra_class); ?>">
            <div class="container">
                <div class="content-row">
                    <div class="row align-items-center gx-xxl-70 gx-xl-50 gy-md-30 gy-sm-30">
                        <div class="col-lg-6 order-md-first order-last col-md-6 col-sm-12 col-12">
                            <div class="content-title max-width-560 mr-auto wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                if( !empty($heading_content) ){
                                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                                }

                                $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-secondary' );
                                if( $button_attr['status'] ){ ?>
                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                } ?>
                            </div>
                        </div>
                        <div class="col-lg-6 order-md-last order-first col-md-6 col-sm-12 col-12"><?php
                            if( !empty($image) ){ ?>
                                <div class="content-img wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"><span class="parrot-circle-top-left"></span></div><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    } else { ?>
        <section <?php imagroup_section_id($id); ?> class="content-part overflow-hidden pt-xl-75 pb-xl-75 pt-md-65 pb-md-65 pb-35 pt-35 <?php echo esc_attr($extra_class); ?>">
            <div class="container">
                <div class="content-row">
                    <div class="row align-items-center gx-xxl-70 gx-xl-50 gy-md-30 gy-sm-30">
                        <div class="col-lg-6 order-md-first order-last col-md-6 col-sm-12 col-12">
                            <div class="content-title max-width-560 mr-auto wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                if( !empty($heading_content) ){
                                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                                }

                                $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-secondary' );
                                if( $button_attr['status'] ){ ?>
                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                } ?>
                            </div>
                        </div>
                        <div class="col-lg-6 order-md-last order-first col-md-6 col-sm-12 col-12"><?php
                            if( !empty($image) ){ ?>
                                <div class="content-img wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"></div><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    }
}

?>