<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$heading = get_sub_field( 'imagine_thriving_together_heading' ); ?>

    <section <?php imagroup_section_id($id); ?> class="content-part pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pt-100 pb-100 <?php echo esc_attr($extra_class); ?>">
        <div class="container"><?php
            if( !empty($heading) ){ ?>
                <div class="content-title text-center mb-md-60 mb-40 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <h2><?php echo $heading; ?></h2>
                </div><?php
            }

            if( have_rows('imagine_thriving_together_content_boxes') ): ?>
                <div class="content-row">
                    <div class="row align-items-center gx-xl-40 gy-md-30 gy-sm-30"><?php
                        $content_boxes_counter = 1;
                        while( have_rows('imagine_thriving_together_content_boxes') ) : the_row();
                            
                            $heading = get_sub_field('heading');
                            $image = get_sub_field('image');
                            $content = get_sub_field('content');
                            $button = get_sub_field('button'); ?>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card-blog <?php if( $content_boxes_counter == 2 ){ echo 'green'; } ?> wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                    if( !empty($heading) ){ ?>
                                        <div class="card-header">
                                            <h3><?php echo $heading; ?></h3>
                                        </div><?php
                                    } ?>

                                    <div class="card-body"><?php
                                    
                                        if( !empty($image) ){ ?>
                                            <div class="card-img">
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                            </div><?php
                                        }
                                    
                                        if( !empty($content) || !empty($button) ){ ?>
                                            <div class="card-info"><?php
                                                echo imagroup_remove_empty_p( wpautop($content) );

                                                if( $content_boxes_counter == 2 ){
                                                    $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-green' );
                                                } else {
                                                    $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-parrot' );
                                                }
                                                
                                                if( $button_attr['status'] ){  ?>
                                                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                                                } ?>
                                            </div><?php
                                        } ?>
                                    </div>
                                </div>
                            </div><?php

                            if( $content_boxes_counter == 2 ){
                                $content_boxes_counter = 0;
                            }
                            $content_boxes_counter++;
                        endwhile; ?>
                    </div>
                </div><?php
            endif; ?>
        </div>
    </section><?php
}

?>