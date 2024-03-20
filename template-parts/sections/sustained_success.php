<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$heading = get_sub_field( 'sustained_success_heading' ); ?>

    <section <?php imagroup_section_id($id); ?> class="content-part bg-sky-blue pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pt-100 pb-100 <?php echo esc_attr($extra_class); ?>">
        <div class="container" style="padding-top: 0;"><?php
            if( !empty($heading) ){ ?>
                <div class="content-title white-color text-center mb-md-60 mb-40 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <h2><?php echo $heading; ?></h2>
                </div><?php
            }
            
            if( have_rows('sustained_success_services') ): ?>
                <div class="icon-row">
                    <div class="row gx-xl-40 gx-lg-30 gx-md-40 gy-46"><?php
                        while( have_rows('sustained_success_services') ) : the_row();
                            
                            $icon = get_sub_field('icon');
                            $content = get_sub_field('content');
                            $link = get_sub_field('link'); ?>
                        
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="icon-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                    if( !empty($icon) ){ ?>
                                        <span class="icon-img"><img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>"></span><?php
                                    }

                                    if( !empty($content) ){
                                        echo imagroup_remove_empty_p( wpautop($content) );
                                    }

                                    $button_attr = imagroup_acf_link( $link, 'read-more' );
                                    if( $button_attr['status'] ){  ?>
                                        <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?> <i><img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arrow.svg" alt="arrow"></i></a><?php
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