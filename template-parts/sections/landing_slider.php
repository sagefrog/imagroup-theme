<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$bk_image = get_sub_field( 'landing_slider_background_image' ); ?>

    <section <?php imagroup_section_id($id); ?> class="hero-banner <?php echo esc_attr($extra_class); ?>"><?php
        if( !empty($bk_image) ){ ?>
            <div class="hero-spine"><img src="<?php echo esc_url($bk_image['url']); ?>" alt="<?php echo esc_attr($bk_image['alt']); ?>"></div><?php
        } ?>
        <div class="container"><?php

            if( have_rows('landing_slider_slider') ): ?>
                <div class="swiper hero-slider">
					<div class="swiper-wrapper"><?php
                        while( have_rows('landing_slider_slider') ) : the_row();
                            
                            $image = get_sub_field('image');
                            $heading_content = get_sub_field('heading_content');
                            $button = get_sub_field('button'); ?>

                            <div class="swiper-slide">
                                <div class="row align-items-center gy-md-4 gy-4">
                                    <div class="col-lg-5 order-lg-first order-last col-md-12 col-sm-12 col-12">
                                        <div class="hero-caption max-width-420" style="min-height: 340px;">
                                            <span class="hero-cicle"></span><?php
                                            if( !empty($heading_content) ){
                                                echo imagroup_remove_empty_p( wpautop($heading_content) );
                                            }
                                            
                                            $button_attr = imagroup_acf_link( $button, 'btn btn-secondary' );
                                            if( $button_attr['status'] ){ ?>
                                                <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 order-lg-last order-first col-md-12 col-sm-12 col-12">
                                        <div class="hero-image">
                                            <div class="swiper-slide-one">
                                                <span class="hero-slide-big-circle"></span>
                                                <span class="hero-slide-small-circle"></span><?php
                                                if( !empty($image) ){ ?>
                                                    <div class="hero-slide">
                                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                                    </div><?php
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><?php
                        endwhile; ?>
                    </div>
                </div><?php
            endif; ?>
        </div>
        <span class="hero-bottom-circle"><img src="<?php echo IMAGE_ASSETS_URL; ?>/hero-bottom-circle.svg" alt="hero-bottom-circle"></span>
    </section><?php
}

?>