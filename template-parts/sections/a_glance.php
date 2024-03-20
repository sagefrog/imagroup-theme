<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$heading = get_sub_field( 'a_glance_heading' ); ?>

    <section <?php imagroup_section_id($id); ?> class="content-part bg-sky-blue pt-90 pb-90 <?php echo esc_attr($extra_class); ?>">
        <div class="container"><?php
            if( have_rows('a_glance_new_milestones') ): ?>
                <div class="content-row glace-slider-row">
                    <div class="swiper glace-slider">
                        <div class="swiper-wrapper"><?php
                            $milestones_counter = 1;
                            while( have_rows('a_glance_new_milestones') ) : the_row();
                                
                                $heading = get_sub_field('heading'); ?>
                                    
                                <div class="swiper-slide"><?php
                                    if( !empty($heading) ){ ?>
                                        <div class="content-title white-color text-center mb-md-40 mb-40">
                                            <h2><?php echo $heading; ?></h2>
                                        </div><?php
                                    } ?>
                                    <div class="content-row">
                                        <div class="row justify-content-center gx-xl-40 gx-lg-30 gx-md-40 gy-md-5 gy-5"><?php
                                            if( have_rows('milestones') ):
                                                while( have_rows('milestones') ) : the_row();
                                
                                                    $number = get_sub_field('number');
                                                    $postfix = get_sub_field('postfix');
                                                    $content = get_sub_field('content'); ?>

                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                        <div class="counter-blog"><?php
                                                            if( !empty($number) ){ ?>
                                                                <span class="counter-number"><span class="counter"><?php echo $number; ?></span><?php echo $postfix; ?></span><?php
                                                            }
                                                            
                                                            if( !empty($content) ){
                                                                echo imagroup_remove_empty_p( wpautop($content) );
                                                            } ?>
                                                        </div>
                                                    </div><?php
                                                endwhile;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div><?php
                            endwhile; ?>
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div><?php
            endif; ?>
        </div>
    </section><?php
}

?>