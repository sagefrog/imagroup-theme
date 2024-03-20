<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$bk_img = get_sub_field( 'cta_background_image' );
    $heading_content = get_sub_field( 'cta_heading_content' );
    $button = get_sub_field( 'cta_button' ); ?>

    <section <?php imagroup_section_id($id); ?> class="content-part cta-section pt-100 pb-100 banner-bg <?php echo esc_attr($extra_class); ?>" data-background="<?php if( !empty($bk_img) ){ echo esc_url($bk_img['url']); } ?>">
        <div class="overlay-parrot"></div>
        <div class="container">
            <div class="content-title text-center"><?php
                if( !empty($heading_content) ){
                    echo imagroup_remove_empty_p( wpautop($heading_content) );
                }

                $button_attr = imagroup_acf_link( $button, 'btn btn-white' );
                if( $button_attr['status'] ){ ?>
                    <a <?php echo $button_attr['attributes']; ?>><?php echo $button_attr['title']; ?></a><?php
                } ?>
            </div>
        </div>
    </section><?php
}

?>