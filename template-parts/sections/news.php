<?php

$page_id = get_the_id();

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );

if( $status == 'show' ){

	$layout = get_sub_field( 'news_layout' );
    $heading = get_sub_field( 'news_heading' );
    $content = get_sub_field( 'news_content' );
    $limit = get_sub_field( 'news_limit' );

    if( $layout == 2 ){
        
        $category = 'all';
        if( isset($_GET['category']) && !empty($_GET['category']) ){
            $category = $_GET['category'];
        } ?>
        
        <section <?php imagroup_section_id($id); ?> class="knowledge-banner pt-md-90 pb-xl-150 pb-md-125 pb-100 pt-60 banner-bg <?php echo esc_attr($extra_class); ?>" data-background="<?php echo IMAGE_ASSETS_URL; ?>/contact-banner.png">
            <div class="contact-banner-mobile banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/contact-banner-mobile.png"></div>
            <div class="container">
                <div class="content-title body-xl text-center max-width-743 mb-md-50 mb-35 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                    if( !empty($heading) ){ ?>
                        <h1><?php echo $heading; ?></h1><?php
                    }
                    
                    if( !empty($content) ){
                        echo imagroup_remove_empty_p( wpautop($content) );
                    } ?>
                </div>
                <div class="portfoliofilter wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <a href="<?php echo get_the_permalink($page_id); ?>" class="<?php if( $category == 'all' ){ echo 'active'; } ?>"><?php echo esc_html__( 'ALL MEDIA', 'imagroup' ); ?></a><?php
                    $terms = get_terms( 'category', array( 'hide_empty' => false ) );
                    if( $terms && ! is_wp_error( $terms ) ) :
                        foreach( $terms as $term ){ ?>
                            <a href="<?php echo get_the_permalink($page_id); ?>?category=<?php echo esc_attr($term->slug); ?>" class="<?php if( $category == $term->slug ){ echo 'active'; } ?>"><?php echo $term->name; ?></a><?php
                        }
                    endif; ?>
                </div><?php

                $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
 
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $limit,
                    'paged' => $paged,
                );

                $tax_query = array();

                if( !empty($category) && $category != 'all' ){
                    $tax_query[] = array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $category
                    );
                }
                
                $tax_count = count($tax_query);

                $tax_query['relation'] = 'AND';

                if( $tax_count > 0 ){
                    $args['tax_query'] = $tax_query;
                }

                $post_query = new WP_Query( $args );

                $total_records = $post_query->found_posts;

                if( $post_query->have_posts() ) : ?>
                    <div class="content-row">
                        <div class="row gx-xl-40 gx-lg-30 gx-md-40 gy-40 posts-list-area"><?php
                            while( $post_query->have_posts() ) : $post_query->the_post();
                                $postId = get_the_id();
                                
                                $blog_img = wp_get_attachment_image_url( get_post_thumbnail_id( $postId ), 'full' );
                                
                                $external_url = get_field( 'external_url', $postId );
                                if( !empty($external_url) ){
                                    $post_link = $external_url;
                                    $target = "_blank";
                                } else {
                                    $post_link = get_the_permalink($postId);
                                    $target = "";
                                } ?>

                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <a href="<?php echo esc_url($post_link); ?>" target="<?php echo esc_url($target); ?>" class="post-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                        if( !empty($blog_img) ){ ?>
                                            <div style="height: 200px;" class="post-blog-img">
                                                <img style="height: 100%; object-fit: cover;" src="<?php echo esc_url($blog_img); ?>" alt="<?php echo imagroup_attachment_caption( get_post_thumbnail_id( $postId ) ); ?>">
                                            </div><?php
                                        } ?>
                                        <p><?php echo get_the_title($postId); ?></p>
                                        <span class="read-more"><?php echo esc_html__( 'VIEW', 'imagroup' ); ?> <img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arrow.svg" alt="arrow"></span>
                                    </a>
                                </div><?php
                            endwhile; ?>
                        </div>
                    </div><?php
                endif;

                if( $limit < $total_records ){ ?>
                    <div class="btn-outer center-align mt-md-70 mt-45">
                        <a href="javascript:void(0);" class="btn btn2 btn-secondary posts-load-more-btn"><?php echo esc_html__( 'LOAD MORE', 'imagroup' ); ?></a>
                        <form name="posts-load-more" class="posts-load-more" method="post">
                            <input type="hidden" name="paged" value="<?php echo esc_attr($paged); ?>">
                            <input type="hidden" name="limit" value="<?php echo esc_attr($limit); ?>">
                            <input type="hidden" name="category" value="<?php echo esc_attr($category); ?>">
                            <input type="hidden" name="action" value="imagroup_posts_load_more_ajax">
                        </form>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function() {
                            jQuery('.posts-load-more-btn').on( 'click', function(){
                                var $form = jQuery('form.posts-load-more');

                                jQuery.ajax({
                                    type: 'post',
                                    url: '<?php echo get_admin_url(); ?>'+'admin-ajax.php',
                                    dataType: 'json',
                                    data: $form.serialize(),
                                    beforeSend: function () {
                                        jQuery('.posts-load-more-btn').html('Loading...');
                                    },
                                    success: function( response ) {
                                        if( response.data ){
                                            jQuery('.posts-list-area').append(response.data);
                                            if( response.paged ){
                                                jQuery('.posts-load-more-btn').html('LOAD MORE');
                                                jQuery('input[name="paged"]').val(response.paged);
                                            } else {
                                                jQuery('.posts-load-more-btn').parent().remove();
                                            }
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        var err = eval("(" + xhr.responseText + ")");
                                        console.log(err.Message);
                                    }
                                });
                            });
                        });
                    </script><?php
                } ?>
            </div>
        </section><?php
    } 
    else { ?>
        <section <?php imagroup_section_id($id); ?> class="content-part news-section bg-blue-two mobile-banner-none pt-xl-150 pb-xl-150 pt-md-125 pb-md-125 pt-100 pb-100 banner-bg <?php echo esc_attr($extra_class); ?>" data-background="<?php echo IMAGE_ASSETS_URL; ?>/banner4.png">
            <div class="mobile-banner banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/banner-mobile4.png"></div>
            <div class="container"><?php
                if( !empty($heading) ){ ?>
                    <div class="content-title white-color text-center mb-md-30 mb-40 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                        <h2><?php echo $heading; ?></h2>
                    </div><?php
                }
                
                $news_posts = get_posts( array( 'post_type' => 'post', 'posts_per_page' => $limit, 'post_status' => 'publish' ) );
                if( $news_posts ){ ?>
                    <div class="content-row">
                        <div class="row gx-xl-40 gx-lg-30 gx-md-40 gy-md-5 gy-sm-30"><?php
                            foreach( $news_posts as $post ) : 
                                
                                $external_url = get_field( 'external_url', $post->ID );
                                if( !empty($external_url) ){
                                    $post_link = $external_url;
                                    $target = "_blank";
                                } else {
                                    $post_link = get_the_permalink($post->ID);
                                    $target = "";
                                } ?>

                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="news-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                        $news_thumbnail = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'news-thumbnail' );
                                        if( !empty($news_thumbnail) ){ ?>
                                            <a href="<?php echo esc_url($post_link); ?>" target="<?php echo esc_url($target); ?>" class="gallery-item">
                                                <img src="<?php echo esc_url($news_thumbnail); ?>" alt="<?php echo imagroup_attachment_caption( get_post_thumbnail_id( $post->ID ) ); ?>">
                                            </a><?php
                                        } ?>
                                        <div class="news-blog-info">
                                            <h3><a href="<?php echo get_the_permalink($post->ID); ?>" target="<?php echo esc_url($target); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                                            <a target="<?php echo esc_url($target); ?>" href="<?php echo get_the_permalink($post->ID); ?>" class="read-more">READ MORE <i><img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arw_aqua.svg" alt="btn-arrow" class="normal-icon"><img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arrow_yellow.svg" alt="btn-arrow" class="hover-icon"></i></a>
                                        </div>
                                    </div>
                                </div><?php
                            endforeach;
                            ?>
                        </div>
                    </div><?php
                } ?>
            </div>
        </section><?php
    }
}
wp_reset_query();
?>