<?
get_header();
while (have_posts()) : the_post();
  $postId = get_the_id();

  $post_img = wp_get_attachment_image_url(get_post_thumbnail_id($postId), 'full');
?>
  <section class="post-header bg-blue">
    <div class="container">
      <div class="post-header-img banner-bg" data-background="<? echo esc_url($post_img); ?>"></div>
    </div>
  </section>
  <section class="post-detail-section pt-md-60 pb-xl-150 pb-md-125 pt-40 pb-100">
    <div class="container">
      <div class="post-detail-row">
        <div class="row gx-xl-40 gy-5">
          <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="post-title">
              <h1>
                <?
                the_title();
                ?>
              </h1>
              <span class="post-meta">
                <span class="post-date">
                  <?
                  the_date();
                  ?>
                </span><span class="post-author">
                  <?
                  echo esc_html__('By', 'imagroup');
                  ?>

                  <?
                  echo get_the_author_meta('display_name');
                  ?>
                </span>
              </span>
              <div class="post-share">
                <label>
                  <?
                  echo esc_html__('Share', 'imagroup');
                  ?>
                </label>
                <ul>
                  <?

                  echo '<li><a class="dropdown-item" href="https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode(get_the_permalink($postId)) . '&title=' . urlencode(get_the_title($postId)) . '&source=' . urlencode(home_url('/')) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><img src="' . IMAGE_ASSETS_URL . '/linkedin-blue.svg" alt="linkedin"></a></li>';
                  echo '<li><a class="dropdown-item" href="https://twitter.com/intent/tweet?text=' . urlencode(get_the_title()) . '&url=' .  urlencode(get_permalink()) . '&via=' . urlencode($twitter_user ? $twitter_user : get_bloginfo('name')) . '" onclick="if(!document.getElementById(\'td_social_networks_buttons\')){window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;}"><img src="' . IMAGE_ASSETS_URL . '/x-twitter.svg" alt="x-twitter"></a></li>';
                  echo '<li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '&amp;t=' . urlencode(get_the_title()) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><img src="' . IMAGE_ASSETS_URL . '/facebook-green.svg" alt="facebook"></a></li>';
                  ?>

                </ul>
              </div>
            </div>
            <div class="post-content">

              <?
              the_content();
              ?>

            </div>
            <div class="post-share">
              <label>
                <?
                echo esc_html__('Share', 'imagroup');
                ?>
              </label>
              <ul>
                <?

                echo '<li><a class="dropdown-item" href="https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode(get_the_permalink($postId)) . '&title=' . urlencode(get_the_title($postId)) . '&source=' . urlencode(home_url('/')) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><img src="' . IMAGE_ASSETS_URL . '/linkedin-blue.svg" alt="linkedin"></a></li>';
                echo '<li><a class="dropdown-item" href="https://twitter.com/intent/tweet?text=' . urlencode(get_the_title()) . '&url=' .  urlencode(get_permalink()) . '&via=' . urlencode($twitter_user ? $twitter_user : get_bloginfo('name')) . '" onclick="if(!document.getElementById(\'td_social_networks_buttons\')){window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;}"><img src="' . IMAGE_ASSETS_URL . '/x-twitter.svg" alt="x-twitter"></a></li>';
                echo '<li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '&amp;t=' . urlencode(get_the_title()) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><img src="' . IMAGE_ASSETS_URL . '/facebook-green.svg" alt="facebook"></a></li>';
                ?>

              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-12">
            <?
            $related_posts;
            $categories = get_the_category($postId);
            if ($categories) :
              $cat_ids = array();
              foreach ($categories as $individual_cat) {
                $cat_ids[] = $individual_cat->term_id;
              }

              $args = array(
                'category__in' => $cat_ids,
                'post__not_in' => array($postId),
                'posts_per_page' => '3'
              );
              $related_posts = get_posts($args);
            endif;

            if ($related_posts) :
            ?>
              <div class="related-post">
                <?
                foreach ($related_posts as $post) :
                  $blog_img = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'full');
                  $external_url = get_field('external_url', $post->ID);
                  if (!empty($external_url)) {
                    $post_link = $external_url;
                    $target = "_blank";
                  } else {
                    $post_link = get_the_permalink($post->ID);
                    $target = "";
                  }
                ?>
                  <a href="<? echo esc_url($post_link); ?>" target="<? echo esc_url($target); ?>" class="post-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <?
                    if (!empty($blog_img)) :
                    ?>
                      <div class="post-blog-img" style="height: 145px;">
                        <img style="height: 100%; object-fit: cover;" src="<? echo esc_url($blog_img); ?>" alt="<? echo imagroup_attachment_caption(get_post_thumbnail_id($post->ID)); ?>">
                      </div>
                    <?
                    endif;
                    ?>
                    <p>
                      <?
                      echo get_the_title($post->ID);
                      ?>
                    </p>
                    <span class="read-more">
                      <?
                      echo esc_html__('VIEW ARTICLE', 'imagroup');
                      ?>
                      <i>
                        <img src="<? echo IMAGE_ASSETS_URL; ?>/btn_arrow_yellow.svg" alt="arrow" class="normal-icon">
                        <img src="<? echo IMAGE_ASSETS_URL; ?>/btn_arw_blue.svg" alt="arrow" class="hover-icon">
                      </i>
                    </span>
                  </a>
                <?
                endforeach;
                ?>
              </div>
            <? 
            endif;
            ?>
          </div>
          
      </div>
    </div>
  </section>
<?
endwhile;
get_footer();
?>