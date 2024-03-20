<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$overlay_color = get_sub_field( 'full_width_content_image_background_overlay_color' );
    $desktop_image = get_sub_field( 'full_width_content_image_desktop_image' );
    $mobile_image = get_sub_field( 'full_width_content_image_mobile_image' );
    $sub_heading = get_sub_field( 'full_width_content_image_sub_heading' );
    $heading_content = get_sub_field( 'full_width_content_image_heading_+_content' );
    $button = get_sub_field( 'full_width_content_image_button' );
    
    if( empty($mobile_image) ){
        $mobile_image = $desktop_image;
    } ?>

    <section <?php imagroup_section_id($id); ?> class="content-part <?php echo esc_attr($overlay_color); ?> mobile-banner-none pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pb-100 banner-bg <?php echo esc_attr($extra_class); ?>" data-background="<?php if( !empty($desktop_image) ){ echo esc_url($desktop_image['url']); } ?>">
        <div class="content-mobile-banner banner-bg" data-background="<?php if( !empty($mobile_image) ){ echo esc_url($mobile_image['url']); } ?>"></div>
        <div class="container">
            <div class="content-row">
                <div class="row">
                    <div class="col-lg-5 col-md-7 col-sm-12 col-12">
                        <div class="content-title max-width-424 ml-auto <?php if( $overlay_color == 'bg-blue' ){ echo 'white-color'; } ?> body-xl wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                            if( !empty($sub_heading) ){ ?>
                                <span class="sub-title"><?php echo $sub_heading; ?></span><?php
                            }
                            
                            if( !empty($heading_content) ){
                                echo imagroup_remove_empty_p( wpautop($heading_content) );
                            }

                            $button_attr = imagroup_acf_link( $button, 'btn btn2 btn-primary' );
                            if( $button_attr['status'] ){ ?>
                                <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><?php
}

?>