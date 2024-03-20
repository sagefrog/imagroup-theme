<?
get_header();
?>

<section class="content-part pt-50 pb-md-100 pb-150">
  <div class="container max-container">
    <div class="content-title text-center mb-md-120 mb-50 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
      <h1 class="maxtitle-1"><?= get_the_archive_title(); ?></h1>
    </div>
    <?
    if ($wp_query->have_posts()) :
      $_paged = get_query_var('paged');
    ?>
      <div class="news-row">
        <div class="row">
          <?
          while ($wp_query->have_posts()) : $wp_query->the_post();
            $postId = get_the_id();

            $post_thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id($postId), 'news-thumbnail');
          ?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
              <div class="post-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                <? if (!empty($post_thumbnail)) : ?>
                  <a href="<?= get_the_permalink($postId); ?>" class="gallery-item wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                    <img src="<?= esc_url($post_thumbnail); ?>" alt="<?= imagroup_attachment_caption(get_post_thumbnail_id($postId)); ?>">
                  </a>
                <? endif; ?>
                <div class="post-info">
                  <h3 class="wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="0.5s"><a href="<?= get_the_permalink($postId); ?>"><?= get_the_title($postId); ?></a></h3>
                  <p class="wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="0.5s"><?= get_the_excerpt($postId); ?></p>
                  <a href="<?= get_the_permalink($postId); ?>" class="read-more wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="0.5s"><?= esc_html__('Read more', 'imagroup'); ?></a>
                </div>
              </div>
            </div>
          <? endwhile; ?>
        </div>
        <? imagroup_pagination($wp_query->max_num_pages, $_paged); ?>
      </div>
    <?
    endif;
    ?>
  </div>
</section>
<?

get_footer();

?>