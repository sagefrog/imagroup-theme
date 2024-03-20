<?php

get_header();

?>

<section class="content-part pt-md-100 pb-md-200 pt-50 pb-100">
    <div class="content-row">
        <div class="container">
            <div class="content-title center-align mb-md-55 mb-35">
                <span class="red-line mb-15" data-aos="fade-right" data-aos-offset="50" data-aos-delay="300"></span>
                <h2 data-aos="fade-up" data-aos-offset="50" data-aos-delay="300"><?php esc_html_e( 'Search IMAGROUP', 'imagroup' ); ?></h2>
            </div>
            <div class="search-div mb-md-100 mb-50">
                <form name="search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
                    $search_placeholder_text = imagroup_theme_option( 'header_search_placeholder_text' );
                    $search_button_text = imagroup_theme_option( 'header_search_button_text' ); ?>
                    
                    <div class="search-div-input">
                        <input type="text" name="s" value="<?php echo get_search_query() ?>" placeholder="<?php echo esc_attr($search_placeholder_text); ?>">
                        <span class="search-reset hide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/ls_close_gfx.svg" alt="ls_close_gfx" width="10" height="10"></span>
                    </div>
                    <button type="submit" class="main-btn submit-btn">
                        <span class="normal-text"><?php echo $search_button_text; ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-angle-red.svg" alt="btn-angle" width="10" height="10"></span>
                        <span class="hover-text"><?php echo $search_button_text; ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-angle-white.svg" alt="btn-angle" width="10" height="10"></span>
                    </button>
                </form>
            </div>
            <div class="content-row search-post-row">
                <div class="search-result-list"><?php
                    $posts_per_page = get_option('posts_per_page');
                    
                    $the_query = new WP_Query( array( 's' => $_GET['s'], 'post_status' => 'publish', 'posts_per_page' => $posts_per_page, 'paged' => 1 ) );

                    if( $the_query->have_posts() ) :

                        $max_num_pages = $wp_query->max_num_pages;

                        $gated_resources_page = imagroup_theme_option( 'gated_resources_page' );

                        while( $the_query->have_posts() ) : $the_query->the_post();
                          $postId = get_the_id();

                            $gated_resources = get_field( 'redirect_to_gated_resources', $postId ); ?>
                            
                            <div class="post-blog" data-aos="fade-up" data-aos-offset="50" data-aos-delay="300"><?php
                                $post_thumbnail = get_the_post_thumbnail($post);
                                if( !empty($post_thumbnail) ){
                                    if( $gated_resources == 'yes' ){ ?>
                                        <a href="<?php echo get_the_permalink($gated_resources_page); ?>" class="gallery-item"><?php
                                    } else { ?>
                                        <a href="<?php the_permalink(); ?>" class="gallery-item"><?php
                                    }
                                    
                                    the_post_thumbnail( 'resource-thumbnail',  array( 'class' => 'img-responsive' ) ); ?>
                                    
                                    </a><?php
                                } ?>
                                <div class="post-blog-info"><?php
                                    if( !empty(get_the_excerpt($postId)) ){ ?>
                                        <span class="post-line"></span><?php
                                    } ?>
                                    
                                    <h3><?php
                                        if( $gated_resources == 'yes' ){ ?>
                                            <a href="<?php echo get_the_permalink($gated_resources_page); ?>"><?php
                                        } else { ?>
                                            <a href="<?php the_permalink(); ?>"><?php
                                        }
                                        the_title(); ?></a>
                                    </h3><?php

                                    if( !empty(get_the_excerpt($postId)) ){ ?>
                                        <p><?php echo do_shortcode( substr( get_the_excerpt($postId), 0, 270 ) ); ?></p><?php
                                    }

                                    if( $gated_resources == 'yes' ){ ?>
                                        <a href="<?php echo get_the_permalink($gated_resources_page); ?>" class="main-btn"><?php
                                    } else { ?>
                                        <a href="<?php the_permalink(); ?>" class="main-btn"><?php
                                    } ?>
                                    
                                        <span class="normal-text"><?php esc_html_e( 'Learn More', 'imagroup' ); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-angle-gray.svg" alt="btn-angle" width="10" height="10"></span>
                                        <span class="hover-text"><?php esc_html_e( 'Learn More', 'imagroup' ); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-angle-red.svg" alt="btn-angle" width="10" height="10"></span>
                                    </a>
                                </div>
                            </div>
                            <hr class="hr1" data-aos="fade-up" data-aos-offset="50" data-aos-delay="300"><?php
                        endwhile;
                    endif; ?>
                </div><?php

                if( $max_num_pages > 1 ){ ?>
                    <div class="load-more-search-result-area btn-outer center-align">
                        <form>
                            <input type="hidden" name="query" value="<?php echo $_GET['s']; ?>">
                            <input type="hidden" name="paged" class="paged" value="1">
                            <?php wp_nonce_field( 'imagroup_search_result_load_more_nonce', 'imagroup_search_result_load_more_security' ); ?>
                            <input type="hidden" name="action" id="search_result_load_more" value="imagroup_search_result_load_more">
                            <a href="javascript:void(0);" id="search-result-load-more" class="main-btn light-btn blue-span" data-aos="fade-up" data-aos-offset="50" data-aos-delay="300">
                                <span class="normal-text"><?php esc_html_e( 'Learn More', 'imagroup' ); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-angle-red.svg" alt="btn-angle" width="10" height="10"></span>
                                <span class="hover-text"><?php esc_html_e( 'Learn More', 'imagroup' ); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-angle-red.svg" alt="btn-angle" width="10" height="10"></span>
                            </a>
                        </form>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function() {
                            jQuery('#search-result-load-more').on( 'click', function(e){
                                e.preventDefault();
                                search_result_load_more();
                            });

                            var search_result_load_more = function(){

                                var $form = jQuery('.load-more-search-result-area form');

                                jQuery.ajax({
                                    type: 'post',
                                    url: '<?php echo get_admin_url(); ?>'+'admin-ajax.php',
                                    dataType: 'json',
                                    data: $form.serialize(),
                                    beforeSend: function (){
                                        
                                    },
                                    success: function( response ){
                                        
                                        var $items = jQuery(response.post_html);
                                        jQuery('.search-result-list').append($items);
                                        
                                        if( response.getPosts ){
                                            var $paged = response.paged;
                                            jQuery('.paged').val($paged);
                                        } else {
                                            var $items = jQuery(response.post_html);
                                            jQuery('.search-result-list').append($items);
                                            jQuery('.load-more-search-result-area').remove();
                                        }

                                        AOS.init({
                                            duration: 700,
                                            anchorPlacement: 'bottom-bottom',
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        var err = eval("(" + xhr.responseText + ")");
                                        console.log(err.Message);
                                    }
                                });
                            }
                        });
                    </script><?php
                } ?>
            </div>
        </div>
    </div>
</section><?php

get_footer();

?>