<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$heading = get_sub_field( 'workers_compensation_heading' ); ?>

    <section <?php imagroup_section_id($id); ?> class="content-part bg-blue-three pt-90 pb-100 <?php echo esc_attr($extra_class); ?>">
        <div class="container"><?php
            if( !empty($heading) ){ ?>
                <div class="content-title white-color text-center mb-md-40 mb-40 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <h2><?php echo $heading; ?></h2>
                </div><?php
            }
            
            if( have_rows('workers_compensation_features') ): ?>
                <div class="content-row">
                    <div class="row justify-content-center gx-xl-40 gx-lg-30 gx-md-40 gy-30"><?php
                        while( have_rows('workers_compensation_features') ) : the_row();
                            
                            $icon = get_sub_field('icon');
                            $content = get_sub_field('content'); ?>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="check-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                    if( !empty($icon) ){ ?>
                                        <span class="check-blog-icon"><img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>"></span><?php
                                    }

                                    if( !empty($content) ){
                                        echo imagroup_remove_empty_p( wpautop($content) );
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