<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$heading = get_sub_field( 'our_reach_heading' ); ?>

    <section <?php imagroup_section_id($id); ?> class="content-part pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pt-100 pb-100 <?php echo esc_attr($extra_class); ?>">
        <div class="container"><?php
            if( !empty($heading) ){ ?>
                <div class="content-title text-center mb-md-40 mb-40 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <h2><?php echo $heading; ?></h2>
                </div><?php
            }

            if( have_rows('our_reach_milestones') ): ?>
                <div class="content-row">
                    <div class="row gx-xl-40 gx-lg-30 gx-md-40 gy-md-5 gy-5"><?php
                        while( have_rows('our_reach_milestones') ) : the_row();
                            
                            $color = get_sub_field('color');
                            $number = get_sub_field('number');
                            $postfix = get_sub_field('postfix');
                            $content = get_sub_field('content'); ?>

                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
								<div class="counter-blog <?php echo esc_attr($color); ?> wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                    if( !empty($number) || !empty($postfix) ){ ?>
									    <span class="counter-number"><span class="counter"><?php echo $number; ?></span><?php echo $postfix; ?></span><?php
                                    } else { ?>
                                        <div class="big-text"><?php
                                    }
                                    
                                    if( !empty($content) ){
                                        echo imagroup_remove_empty_p( wpautop($content) );
                                    }
                                    
                                    if( empty($number) && empty($postfix) ){ ?>
                                        </div><?php
                                    } ?>
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