<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$layout = get_sub_field( 'hero_banner_layout' );
    $desktop_image = get_sub_field( 'hero_banner_desktop_image' );
    $mobile_image = get_sub_field( 'hero_banner_mobile_image' );
    $image = get_sub_field( 'hero_banner_image' );
    $heading_content = get_sub_field( 'hero_banner_heading_content' );
    $button = get_sub_field( 'hero_banner_button' );
    
    if( empty($mobile_image) ){
        $mobile_image = $desktop_image;
    }
    
    if( $layout == 3 ){ ?>
        <section <?php imagroup_section_id($id); ?> class="content-part gray-banner pb-xl-70 pt-md-125 pb-md-125 pt-40 pb-100 <?php echo esc_attr($extra_class); ?>">
            <div class="gray-banner-img banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/vektor2.png">
                <div class="gray-banner-img-mobile banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/vektor-mobile1.png"></div>
            </div>
            <div class="container">
                <div class="content-row">
                    <div class="row">
                        <div class="col-lg-7 order-lg-first order-last col-md-12 col-sm-12 col-12">
                            <div class="content-title gray-banner-caption body-xl wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                if( !empty($heading_content) ){
                                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                                }
                                
                                $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-secondary' );
                                if( $button_attr['status'] ){  ?>
                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                } ?>
                            </div>
                        </div>
                        <div class="col-lg-5 order-lg-last order-first col-md-12 col-sm-12 col-12"><?php
                            if( !empty($image) ){ ?>
                                <div class="content-img width-auto wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"></div><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    } else if( $layout == 2 ){ ?>
        <section <?php imagroup_section_id($id); ?> class="content-part gray-banner pb-xl-70 pt-md-125 pb-md-125 pt-40 pb-100 <?php echo esc_attr($extra_class); ?>">
            <div class="gray-banner-img banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/vektor1.png">
                <div class="gray-banner-img-mobile banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/vektor-mobile1.png"></div>
            </div>
            <div class="container">
                <div class="content-row">
                    <div class="row">
                        <div class="col-lg-7 order-lg-first order-last col-md-12 col-sm-12 col-12">
                            <div class="content-title gray-banner-caption body-xl wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                if( !empty($heading_content) ){
                                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                                }
                                
                                $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-secondary' );
                                if( $button_attr['status'] ){  ?>
                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                } ?>
                            </div>
                        </div>
                        <div class="col-lg-5 order-lg-last order-first col-md-12 col-sm-12 col-12"><?php
                            if( !empty($image) ){ ?>
                                <div class="content-img width-auto wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"></div><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    } else { ?>
        <section <?php imagroup_section_id($id); ?> class="content-part sub-banner mobile-banner-none pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pb-100 banner-bg <?php echo esc_attr($extra_class); ?>" data-background="<?php if( !empty($desktop_image) ){ echo esc_url($desktop_image['url']); } ?>"><?php
            if( !empty($mobile_image) ){ ?>
                <div class="content-mobile-banner banner-bg" data-background="<?php echo esc_url($mobile_image['url']); ?>"></div><?php
            } ?>
            <div class="container">
                <div class="content-row">
                    <div class="row">
                        <div class="col-lg-6 col-md-7 col-sm-12 col-12">
                            <div class="content-title max-width-560 mr-auto body-xl wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                if( !empty($heading_content) ){
                                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                                }
                                
                                $button_attr = imagroup_acf_link( $link, 'btn btn2 btn-secondary' );
                                if( $button_attr['status'] ){  ?>
                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    }
}

?>