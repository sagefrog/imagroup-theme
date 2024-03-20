<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$bk_image = get_sub_field( 'what_we_do_background_image' );
    $heading = get_sub_field( 'what_we_do_heading' ); ?>

    <section <?php imagroup_section_id($id); ?> class="what_we_do content-part pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pt-100 pb-100 banner-bg <?php echo esc_attr($extra_class); ?>" data-background="<?php if( !empty($bk_image) ){ echo esc_url($bk_image['url']); } ?>">
        <div class="moon-shape banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/shp_d.svg">
            <div class="moon-shape-mobile banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/shp_m.svg"></div>
        </div>
        <div class="container"><?php
            if( !empty($heading) ){ ?>
                <div class="content-title white-color text-center mb-md-50 mb-40 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <h2><?php echo $heading; ?></h2>
                </div><?php
            }

            if( have_rows('what_we_do_content_boxes') ): ?>
                <div class="content-row">
                    <div class="row gx-md-40 gy-50"><?php
                        while( have_rows('what_we_do_content_boxes') ) : the_row();
                            
                            $heading = get_sub_field('heading');
                            $image = get_sub_field('image');
                            $content = get_sub_field('content');
                            $links_buttons = get_sub_field('links_buttons'); ?>

                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
								<div class="service-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                    if( !empty($heading) ){ ?>
                                        <div class="service-blog-title">
                                            <h3><?php echo $heading; ?></h3>
                                        </div><?php
                                    }
                                    
                                    if( !empty($image) ){ ?>
									    <div class="service-blog-img">
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                        </div><?php
                                    }
                                    
                                    if( !empty($content) ){ ?>
                                        <div class="service-blog-info">
                                            <?php echo imagroup_remove_empty_p( wpautop($content) ); ?>
                                        </div><?php
                                    }
                                    
                                    if( have_rows('links_buttons') ): ?>
                                        <div class="service-bottom">
                                            <span class="service-arrow"><img src="<?php echo IMAGE_ASSETS_URL; ?>/blue-arrow-down.svg" alt="arrow-down"></span><?php
                                            if( count($links_buttons) > 1 ){ ?>
                                                <ul><?php
                                            }

                                            while( have_rows('links_buttons') ) : the_row();
                                                $link_button = get_sub_field('link_button');

                                                $button_attr = imagroup_acf_link( $link_button, '' );
                                                if( $button_attr['status'] ){
                                                    if( count($links_buttons) > 1 ){ ?>
                                                        <li><a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?> <img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arrow_yellow.svg" alt="btn_arrow_yellow"></a></li><?php
                                                    } else {
                                                        if( $button_attr['status'] ){  ?>
                                                            <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?> <img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arrow_yellow.svg" alt="btn_arrow_yellow"></a><?php
                                                        }
                                                    }
                                                }
                                            endwhile;
                                            
                                            if( count($links_buttons) > 1 ){ ?>
                                                </ul><?php
                                            } ?>
                                        </div><?php
                                    endif; ?>
								</div>
							</div><?php
                        endwhile; ?>
                    </div>
                </div><?php
            endif; ?>
        </div>
    </section><?php
}

?>