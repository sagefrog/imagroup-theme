<?php

$status = get_sub_field('section_display_status');

$id = get_sub_field('section_id');
$extra_class = get_sub_field('section_extra_class');

if ($status == 'show') {

  $heading_content = get_sub_field('where_to_find_us_heading_content'); ?>

  <section <?php imagroup_section_id($id); ?> class="content-part pb-xl-150 pb-md-125 pb-100 pt-md-90 pt-40 <?php echo esc_attr($extra_class); ?>">
    <div class="container"><?php
                            if (!empty($heading_content)) { ?>
        <div class="content-title body-xl text-start text-md-center mb-md-40 mb-35 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
          <?php echo imagroup_remove_empty_p(wpautop($heading_content)); ?>
        </div><?php
                            } ?>
      <form name="where-to-find-us" method="post">
        <div class="address-filter mb-50 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
          <label><?php echo esc_html__('FILTER BY:', 'imagroup'); ?></label>
          <div class="address-filter-form">
            <select name="state" class="selectpicker form-control" title="<?php echo esc_html__('State', 'imagroup'); ?>" data-selected-text-format="count > 1" aria-label="<?php echo esc_html__('State', 'imagroup'); ?>" data-live-search="false">
              <option value=""><?php echo esc_html__('All', 'imagroup'); ?></option>
              <?php
              $state = get_terms(array('taxonomy' => 'find-us-state'));
              if (!empty($state)) {
                foreach ($state as $term) { ?>
                  <option value="<?php echo esc_attr($term->slug); ?>"><?php echo $term->name; ?></option>
              <?php }
              } ?>
            </select>
            <input type="number" name="zip" placeholder="<?php echo esc_html__('Zip Code', 'imagroup'); ?>">
            <input type="hidden" name="action" value="where_find_us_ajax">
          </div>
        </div>
      </form>
      <div class="content-row">
        <div class="row gy-40 gx-xl-40 find-us-result">
          <?php
          $find_us_posts = get_posts(array(
            'post_type' => 'find-us',
            'posts_per_page' => -1,
            'post_status' => 'publish',
          ));

          if ($find_us_posts) {
            usort($find_us_posts, function ($a, $b) {
              return strcmp(get_the_title($a->ID), get_the_title($b->ID));
            });
            foreach ($find_us_posts as $post) :
          ?>

              <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="address-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                  <?php
                  $post_img = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'news-thumbnail');
                  if (!empty($post_img)) { ?>
                    <div class="address-img">
                      <img src="<?php echo esc_url($post_img); ?>" alt="<?php echo imagroup_attachment_caption(get_post_thumbnail_id($post->ID)); ?>">
                    </div>
                  <?php } ?>

                  <h3><?php echo get_the_title($post->ID); ?></h3>

                  <p><?php echo get_field('address', $post->ID); ?></p>

                  <?php $phone = get_field('phone'); ?>
                  <?php
                  // Phone
                  if (!empty($phone)) { ?>
                    <p><?php echo get_field('phone', $post->ID); ?></p>
                  <?php } ?>

                  <?php
                  // Location Type
                  $typeTerms = get_the_terms($post->ID, 'findus-location-type'); ?>
                  <?php if (!empty($typeTerms)) { ?>
                    <p class="location-types">
                      <?php
                      $typeName = wp_list_pluck($typeTerms, 'name'); ?>
                      <span><?php echo implode(', ', $typeName); ?></span>
                    </p>
                  <?php } ?>

                </div>
              </div>
          <?php endforeach;
          } ?>
        </div>
      </div>
    </div>
  </section>
<?php } ?>