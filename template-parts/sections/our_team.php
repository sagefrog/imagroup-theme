<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$layout = get_sub_field( 'our_team_layout' );
    $heading_content = get_sub_field( 'our_team_heading_content' );
    
    if( $layout == 2 ){ ?>
        <section <?php imagroup_section_id($id); ?> class="content-part team-director-section pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pt-100 pb-100 banner-bg <?php echo esc_attr($extra_class); ?>" data-background="<?php echo IMAGE_ASSETS_URL; ?>/banner8.png">
            <div class="container"><?php
                if( !empty($heading_content) ){ ?>
                    <div class="content-title text-center mb-md-60 mb-40 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                        <?php echo imagroup_remove_empty_p( wpautop($heading_content) ); ?>
                    </div><?php
                }
                
                if( have_rows('our_team_team_members') ): ?>
                    <div class="team-row">
						<div class="row gx-xl-40 gy-md-30 gy-sm-30"><?php
                            while( have_rows('our_team_team_members') ) : the_row();
                                
                                $uniqid = uniqid();
                                $photo = get_sub_field('photo');
                                $name = get_sub_field('name');
                                $position = get_sub_field('position');
                                $content = get_sub_field('content');
                                $linkedin = get_sub_field('linkedin'); ?>

                                <div class="col-lg-4 col-md-4 col-sm-6 col-12" style="display: flex; flex-direction: column; justify-content: space-between;">
                                    <div class="team-blog-round wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                        if( !empty($photo) ){ ?>
                                            <div class="team-img"><img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>"></div><?php
                                        } ?>
                                        <div class="team-info">
                                            <h3><?php echo $name; ?></h3>
                                            <p><?php echo $position; ?></p>
                                        </div>
                                    </div>
                                    <div class="team-link wow fadeInUp" style="justify-content: center;" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                                if( !empty($linkedin) ){ ?>
                                                    <a href="<?php echo esc_url($linkedin); ?>" class="team-linkedin" target="_blank"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin-hover.svg" alt="linkedin" class="normal-icon"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin-parrot.svg" alt="linkedin" class="hover-icon"></a><?php
                                                } ?>
                                                <a href="javascript:void(0);" data-fancybox data-src="#member-<?php echo esc_attr($uniqid); ?>" class="team-bio-link"><?php echo esc_html__( 'VIEW BIO', 'imagroup' ); ?> <i><img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arrow.svg" alt="btn_arrow" class="normal-icon"><img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arw_blue.svg" alt="btn_arw_blue" class="hover-icon"></i></a>
                                            </div>
                                    <div class="d-none">
                                        <div class="team-bio-popup banner-bg" id="member-<?php echo esc_attr($uniqid); ?>" data-background="<?php echo IMAGE_ASSETS_URL; ?>/vektor5.svg">
                                            <div class="team-bio-popup-outer">
                                                <div class="team-bio-row">
                                                    <div class="row gx-xl-40 gy-30">
                                                        <div class="col-lg-5 col-md-5 col-sm-12 col-12"><?php
                                                            if( !empty($photo) ){ ?>
                                                                <div class="team-img"><img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>"></div><?php
                                                            } ?>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                                                            <div class="team-bio-header">
                                                                <h3><?php echo $name; if( !empty($linkedin) ){ ?> <span></span> <a href="<?php echo esc_url($linkedin); ?>" class="team-linkedin" target="_blank"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin-hover.svg" alt="linkedin" class="normal-icon"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin-parrot.svg" alt="linkedin" class="hover-icon"></a><?php } ?></h3>
                                                            </div>
                                                            <div class="team-bio-info">
                                                                <span class="tea-bio-pos"><?php echo $position; ?></span>
                                                                <?php echo imagroup_remove_empty_p( wpautop($content) ); ?>
                                                            </div>
                                                        </div>
                                                    </div>
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
        </section><?php
    } else { ?>
        <section <?php imagroup_section_id($id); ?> class="content-part bg-light-blue-50 pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pt-100 pb-100 <?php echo esc_attr($extra_class); ?>">
            <div class="container"><?php
                if( !empty($heading_content) ){ ?>
                    <div class="content-title heading-color-primary max-width-760 text-start text-md-center mb-md-60 mb-40 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                        <?php echo imagroup_remove_empty_p( wpautop($heading_content) ); ?>
                    </div><?php
                }
                
                if( have_rows('our_team_team_members') ): ?>
                    <div class="team-row">
						<div class="row gx-xl-40 gy-md-30 gy-sm-30"><?php
                            while( have_rows('our_team_team_members') ) : the_row();
                                
                                $uniqid = uniqid();
                                $photo = get_sub_field('photo');
                                $name = get_sub_field('name');
                                $position = get_sub_field('position');
                                $content = get_sub_field('content');
                                $linkedin = get_sub_field('linkedin'); ?>

                                <div class="col-lg-4 col-md-4 col-sm-6 col-12" style="display: flex; flex-direction: column; justify-content: space-between;">
                                    <div class="team-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                        if( !empty($photo) ){ ?>
                                            <div class="team-img"><img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>"></div><?php
                                        } ?>
                                        <div class="team-info">
                                            <h3><?php echo $name; ?></h3>
                                            <p><?php echo $position; ?></p>
                                        </div>
                                    </div>
                                    <div class="team-link wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                                if( !empty($linkedin) ){ ?>
                                                    <a href="<?php echo esc_url($linkedin); ?>" class="team-linkedin" target="_blank"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin-hover.svg" alt="linkedin" class="normal-icon"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin-parrot.svg" alt="linkedin" class="hover-icon"></a><?php
                                                } ?>
                                                <a href="javascript:void(0);" data-fancybox data-src="#member-<?php echo esc_attr($uniqid); ?>" class="team-bio-link"><?php echo esc_html__( 'VIEW BIO', 'imagroup' ); ?> <i><img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arrow.svg" alt="btn_arrow" class="normal-icon"><img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arw_blue.svg" alt="btn_arw_blue" class="hover-icon"></i></a>
                                            </div>
                                    <div class="d-none">
                                        <div class="team-bio-popup banner-bg" id="member-<?php echo esc_attr($uniqid); ?>" data-background="<?php echo IMAGE_ASSETS_URL; ?>/vektor5.svg">
                                            <div class="team-bio-popup-outer">
                                                <div class="team-bio-row">
                                                    <div class="row gx-xl-40 gy-30">
                                                        <div class="col-lg-5 col-md-5 col-sm-12 col-12"><?php
                                                            if( !empty($photo) ){ ?>
                                                                <div class="team-img"><img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>"></div><?php
                                                            } ?>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                                                            <div class="team-bio-header">
                                                                <h3><?php echo $name; if( !empty($linkedin) ){ ?> <span></span> <a href="<?php echo esc_url($linkedin); ?>" class="team-linkedin" target="_blank"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin-hover.svg" alt="linkedin" class="normal-icon"><img src="<?php echo IMAGE_ASSETS_URL; ?>/linkedin-parrot.svg" alt="linkedin" class="hover-icon"></a><?php } ?></h3>
                                                            </div>
                                                            <div class="team-bio-info">
                                                                <span class="tea-bio-pos"><?php echo $position; ?></span>
                                                                <?php echo imagroup_remove_empty_p( wpautop($content) ); ?>
                                                            </div>
                                                        </div>
                                                    </div>
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
        </section><?php
    }
}

?>

<script>
document.querySelectorAll(".team-bio-link").forEach(function (element) {
    element.addEventListener("click", function () {
        window.location.hash = "bio";

        window.addEventListener("hashchange", function () {
            if (window.location.hash !== "#bio") {
                window.location.href = "/about/leadership#leadership";
            }
        });
    });
});
</script>