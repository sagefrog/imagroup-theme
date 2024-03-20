<?php

$status = get_sub_field( 'section_display_status' );

$id = get_sub_field( 'section_id' );
$extra_class = get_sub_field( 'section_extra_class' );
if( $status == 'show' ){

  $heading_content = get_sub_field( 'heading_content_referrals' );
  $repeater = get_sub_field('repeater');    ?>

<section <?php imagroup_section_id($id); ?> class="pt-md-90 pb-xl-150 pb-md-125 pb-100 pt-60 contact-banner referrals <?php echo esc_attr($extra_class); ?>" style="background: url('<?php echo IMAGE_ASSETS_URL; ?>/contact-banner.png')">
        <div class="container">
          <?php

          if( !empty($heading_content) ){ ?>
            <div class="content-title body-xl text-center max-width-675 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
                <?php echo imagroup_remove_empty_p( wpautop($heading_content) ); ?>
            </div><?php
          }

          ?>

        </div><?php
 ?>
    </section>
    
    <section class="referrals_repeater">
    <?php if ($repeater): ?>
        <div class="repeater-container row gx-xl-40 gx-lg-30 gx-md-40 gy-md-5 gy-sm-30">
          <?php foreach ($repeater as $row): ?>
            <div class="item col-lg-4 col-md-6 col-sm-12 col-12 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s" style="display: flex; flex-direction: column; justify-content: space-between;visibility: visible; animation-duration: 0.5s; animation-delay: 0.3s; animation-name: fadeInUp;">
              <div class="wrap">
            <?php if ($row['image'] && $row['image']['url']): ?>
                <img src="<?php echo esc_url($row['image']['url']); ?>" alt="<?php echo esc_url($row['image']['alt']); ?>" width="360">
              <?php endif; ?>

              <?php if ($row['title']): ?>
                <h3 class="white-color"><?php echo esc_html($row['title']); ?></h3>
              <?php endif; ?>

              <?php if ($row['content']): ?>
                <p class="white-color"><?php echo esc_html($row['content']); ?></p>
              <?php endif; ?>
              </div> 

              <?php if ($row['link'] && $row['link']['url']): ?>
                <a class="btn btn-primary btn-text-primary" style="width: max-content;" href="<?php echo esc_url($row['link']['url']); ?>" target="<?php echo esc_attr($row['link']['target']); ?>">
                  <?php echo esc_html($row['link']['title']); ?>
                </a>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

    <?php
}

?>