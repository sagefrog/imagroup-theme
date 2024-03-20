<?php

/*----------------------------------------------------------------------
Get theme options
------------------------------------------------------------------------*/
if (!function_exists('imagroup_theme_option')) {

  function imagroup_theme_option($field, $for = '')
  {

    $output = get_field($field, 'option');

    if (!empty($for)) {
      if (!empty($output)) {
        $output = $output[$for];
      }
    }
    return $output;
  }
}

/*----------------------------------------------------------------------
Remove empty <p> of Visual composer content element
------------------------------------------------------------------------*/
if (!function_exists('imagroup_remove_empty_p')) {

  function imagroup_remove_empty_p($content)
  {
    $content = force_balance_tags($content);
    return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
  }
}

/*----------------------------------------------------------------------
Disable TinyMCE from removing span tags
------------------------------------------------------------------------*/
if (!function_exists('imagroup_override_mce_options')) {

  function imagroup_override_mce_options($initArray)
  {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
  }
  add_filter('tiny_mce_before_init', 'imagroup_override_mce_options');
}

/*----------------------------------------------------------------------
Get attachment caption using attachment url
------------------------------------------------------------------------*/
if (!function_exists('imagroup_attachment_caption')) {

  function imagroup_attachment_caption($attachment_id)
  {

    if (!empty($attachment_id)) {
      if (is_numeric($attachment_id)) {
        $output = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
        if (empty($output)) {
          $output = get_the_title($attachment_id);
        }
      } else {
        $new_id = attachment_url_to_postid($attachment_id);
        $output = get_post_meta($new_id, '_wp_attachment_image_alt', true);
        if (empty($output)) {
          $output = get_the_title($new_id);
        }
      }
    } else {
      $output = '';
    }

    return $output;
  }
}

/*----------------------------------------------------------------------
Get ACF element link
------------------------------------------------------------------------*/
if (!function_exists('imagroup_acf_link')) {

  function imagroup_acf_link($a_attr = array(), $class = '')
  {

    $a_detail = array();
    if (!empty($a_attr)) {

      $a_link = $a_attr;
      $a_use_link = false;

      if (strlen($a_link['url']) > 0) {
        $a_attributes = array();
        $a_use_link = true;

        $a_href = $a_link['url'];

        if (!empty($a_link['url'])) {
          $a_href_array = explode('tel:+', $a_link['url']);
          if (!empty($a_href_array) && is_array($a_href_array) && in_array('tel:', $a_href_array)) {
            $a_href_number = str_replace(' ', '', $a_href_array[1]);
            $a_href = 'tel:00' . $a_href_number;
          } else {
            $a_href = apply_filters('vc_btn_a_href', $a_href);
          }
        }

        $a_title = $a_link['title'];

        $a_target = $a_link['target'];

        $a_attributes[] = 'href="' . trim($a_href) . '"';
        $a_attributes[] = 'title="' . esc_attr(trim($a_title)) . '"';

        if (!empty($a_target)) {
          $a_attributes[] = 'target="' . esc_attr(trim($a_target)) . '"';
        }

        if (!empty($a_rel)) {
          $a_attributes[] = 'rel="' . esc_attr(trim($a_rel)) . '"';
        }

        $a_attributes[] = 'class="' . $class . '"';

        $a_attributes = implode(' ', $a_attributes);
      }
      $a_detail['status'] = $a_use_link;
      $a_detail['title'] = $a_title;
      $a_detail['attributes'] = $a_attributes;

      return $a_detail;
    } else {
      $a_detail['status'] = false;
      $a_detail['title'] = '';
      $a_detail['attributes'] = '';

      return $a_detail;
    }
  }
}

/*----------------------------------------------------------------------
Set section id
------------------------------------------------------------------------*/
if (!function_exists('imagroup_section_id')) {

  function imagroup_section_id($id)
  {

    if (!empty($id)) {
      echo 'id="' . $id . '"';
    }
  }
}

/*----------------------------------------------------------------------
Extend WordPress search to include custom fields
------------------------------------------------------------------------*/
function imagroup_search_join($join)
{
  global $wpdb;
  if (is_search()) {
    $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
  }
  return $join;
}
add_filter('posts_join', 'imagroup_search_join');

function imagroup_search_where($where)
{
  global $wpdb;
  if (is_search()) {
    $where = preg_replace("/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/", "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where);
  }
  return $where;
}
add_filter('posts_where', 'imagroup_search_where');

function imagroup_search_distinct($where)
{
  global $wpdb;
  if (is_search()) {
    return "DISTINCT";
  }
  return $where;
}
add_filter('posts_distinct', 'imagroup_search_distinct');

/*----------------------------------------------------------------------
Pagination
------------------------------------------------------------------------*/
if (!function_exists('imagroup_pagination')) {

  function imagroup_pagination($max_num_pages = '', $paged = 1, $range = 2)
  {
    if (empty($paged)) {
      $paged = 1;
    }

    $prev = $paged - 1;
    $next = $paged + 1;
    $showitems = ($range * 2) + 1;
    $range = 2;

    if ($max_num_pages == '') {
      $pages = 5;
      if (!$pages) {
        $pages = 1;
      }
    }

    $end_size = 3;
    $mid_size = 3;

    if (1 != $pages) {

      $dots = false;

      echo '<div class="pagination btn-outer center-align mt-md-100 mt-50 wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="0.7s"><ul>';

      for ($i = 1; $i <= $pages; $i++) {
        if ($paged == $i) {
          echo '<li class="active"><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
          $dots = true;
        } else {
          if ($i <= $end_size || ($paged && $i >= $paged - $mid_size && $i <= $paged + $mid_size) || $i > $pages - $end_size) {
            echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
            $dots = true;
          } else if ($dots) {
            echo '<li><span>...</span></li>';
            $dots = false;
          }
        }
      }

      echo '</ul></div>';
    }
  }
}

/*----------------------------------------------------------------------
Menu shortcode
------------------------------------------------------------------------*/
function imagroup_menu($atts, $content = null)
{

  extract(shortcode_atts(array(
    'id' => '',
    'class' => 'footer-menu',
  ), $atts));

  ob_start();

  if (!empty($id)) {
    wp_nav_menu(array('menu' => $id, 'container' => '', 'items_wrap' => '<ul class="' . $class . '">%3$s</ul>'));
  }

  $output = ob_get_contents();

  ob_end_clean();

  return $output;
}
add_shortcode('menu', 'imagroup_menu');

/*----------------------------------------------------------------------
Button shortcode
------------------------------------------------------------------------*/
function imagroup_button($atts, $content = null)
{

  extract(shortcode_atts(array(
    'link' => '',
    'text' => '',
  ), $atts));

  ob_start(); ?>

  <div class="btn-outer mt-md-50 mt-30">
    <a href="<?php echo esc_url($link); ?>" class="main-btn dark-btn"><?php echo esc_attr($text); ?></a>
  </div><?php

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
      }
      add_shortcode('button', 'imagroup_button');

      /*----------------------------------------------------------------------
Referenzen load more
------------------------------------------------------------------------*/
      if (!function_exists('imagroup_posts_load_more_ajax')) {
        function imagroup_posts_load_more_ajax()
        {
          $paged = $_POST['paged'];
          $limit = $_POST['limit'];
          $category = $_POST['category'];

          ob_start();

          $paged++;

          $args = array(
            'post_type' => 'post',
            'posts_per_page' => $limit,
            'paged' => $paged,
          );

          $tax_query = array();

          if (!empty($category) && $category != 'all') {
            $tax_query[] = array(
              'taxonomy' => 'category',
              'field' => 'slug',
              'terms' => $category
            );
          }

          $tax_count = count($tax_query);

          $tax_query['relation'] = 'AND';

          if ($tax_count > 0) {
            $args['tax_query'] = $tax_query;
          }

          $post_query = new WP_Query($args);

          $total_records = $post_query->found_posts;

          if ($post_query->have_posts()) :
            while ($post_query->have_posts()) : $post_query->the_post();
              $postId = get_the_id();

              $blog_img = wp_get_attachment_image_url(get_post_thumbnail_id($postId), 'news-thumbnail-v2');

              $external_url = get_field('external_url', $postId);
              if (!empty($external_url)) {
                $post_link = $external_url;
                $target = "_blank";
              } else {
                $post_link = get_the_permalink($postId);
                $target = "";
              }
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
          <a href="<?php echo esc_url($post_link); ?>" target="<?php echo esc_url($target); ?>" class="post-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
            <?php if (!empty($blog_img)) : ?>
              <div class="post-blog-img">
                <img src="<?php echo esc_url($blog_img); ?>" alt="<?php echo imagroup_attachment_caption(get_post_thumbnail_id($postId)); ?>">
              </div>
            <?php endif; ?>
            <p><?php echo get_the_title($postId); ?></p>
            <span class="read-more"><?php echo esc_html__('VIEW', 'imagroup'); ?> <img src="<?php echo IMAGE_ASSETS_URL; ?>/btn_arrow.svg" alt="arrow"></span>
          </a>
        </div>
      <?php
            endwhile;
          endif;

          $output = ob_get_contents();

          ob_end_clean();

          if ($post_query->found_posts > ($paged * $limit)) {
            echo json_encode(array('data' => $output, 'paged' => $paged));
          } else {
            echo json_encode(array('data' => $output));
          }
          wp_die();
        }
      }

      add_action('wp_ajax_imagroup_posts_load_more_ajax', 'imagroup_posts_load_more_ajax');
      add_action('wp_ajax_nopriv_imagroup_posts_load_more_ajax', 'imagroup_posts_load_more_ajax');


      /*----------------------------------------------------------------------
Where find us ajax
------------------------------------------------------------------------*/
      if (!function_exists('where_find_us_ajax')) {
        function where_find_us_ajax()
        {
          $state = $_POST['state'];
          $zip = $_POST['zip'];

          $posts_in = [];
          if (strlen(trim($zip)) > 0 && $zip != '') {
            $apikey = imagroup_theme_option('api_key');
            $radius = get_field('radios_to_find_location_based_on_zip', 'option');
            $geocode_response = wp_remote_get('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($zip) . '&key=' . $apikey);
            $geocode_data = json_decode(wp_remote_retrieve_body($geocode_response), true);
            $lat = $lng = null;
            if ($geocode_data['status'] === 'OK') {
              $lat = $geocode_data['results'][0]['geometry']['location']['lat'];
              $lng = $geocode_data['results'][0]['geometry']['location']['lng'];
            }


            if ($lat != null && $lng != null) {
              $data = getAllLatLong();
              foreach ($data as $d) {
                if (trim($d->lat) != '' &&  trim($d->lng) != '') {
                  $distance = haversineDistance($lat, $lng, $d->lat, $d->lng);
                  if ($distance <= $radius) {
                    $posts_in[] = $d->ID;
                  }
                }
              }
            }
          }
          ob_start();

          $search_qry = array(
            'post_type' => 'find-us',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby'        => 'title',
            'order'          => 'ASC',
          );

          // Check if $posts_in is not empty and $zip is not empty and has non-whitespace characters
          if (!empty($posts_in) && strlen(trim($zip)) > 0) {
            $search_qry['post__in'] = $posts_in;
          }

          $tax_query = array();

          // Check if $state is not empty
          if (!empty($state)) {
            $tax_query[] = array(
              'taxonomy' => 'find-us-state',
              'field' => 'slug',
              'terms' => $state
            );
          }

          // Check if $zip is not empty and $posts_in is empty
          if (!empty($zip) && empty($posts_in)) {
            $tax_query[] = array(
              'taxonomy' => 'find-us-zip-code',
              'field'    => 'name',
              'terms'    => $zip,
            );
          }

          // Check if $tax_query is not empty, then add it to the search query
          if (!empty($tax_query)) {
            $search_qry['tax_query'] = $tax_query;
          }

          $find_us_posts = get_posts($search_qry);

          if ($find_us_posts) :
            foreach ($find_us_posts as $post) :
      ?>

        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
          <div class="address-blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s"><?php
                                                                                                $post_img = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'news-thumbnail');
                                                                                                if (!empty($post_img)) { ?>
              <div class="address-img">
                <img src="<?php echo esc_url($post_img); ?>" alt="<?php echo imagroup_attachment_caption(get_post_thumbnail_id($post->ID)); ?>">
              </div><?php
                                                                                                } ?>
            <h3><?php echo get_the_title($post->ID); ?></h3>
            <p><?php echo get_field('address', $post->ID); ?></p>
            <p><?php echo get_field('phone', $post->ID); ?></p>
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
<?
            endforeach;
          endif;

          $output = ob_get_contents();

          ob_end_clean();

          echo json_encode(array('data' => $output));
          wp_die();
        }
      }
      add_action('wp_ajax_where_find_us_ajax', 'where_find_us_ajax');
      add_action('wp_ajax_nopriv_where_find_us_ajax', 'where_find_us_ajax');



      add_action('admin_init', function () {
      });



      // Get all the posts with lat long
      function getAllLatLong()
      {
        global $wpdb;
        // Replace 'your_table_prefix' with your actual WordPress database table prefix
        $meta_table_name = $wpdb->prefix . 'postmeta';
        $post_table_name = $wpdb->prefix . 'posts';

        $meta_key = 'latitude';
        $meta_key2 = 'longitude';
        $post_type = 'find-us';
        $query = $wpdb->prepare(
          "
          SELECT lat.meta_value as lat, lng.meta_value as lng, p.ID FROM $post_table_name as p
          LEFT JOIN $meta_table_name as lat ON(p.ID = lat.post_id AND lat.meta_key = 'latitude')
          LEFT JOIN $meta_table_name as lng ON(p.ID = lng.post_id AND lng.meta_key = 'longitude')
          WHERE p.post_type = 'find-us'
          ",
        );

        $results = $wpdb->get_results($query);

        // Output the results
        if ($results) {
          return $results;
        }
        return [];
      }


      // To calculate the distace between two lat log
      function haversineDistance($lat1, $lon1, $lat2, $lon2)
      {
        $earthRadius = 3959; // Radius of the Earth in miles

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
      }


      class manageFindUsColumn
      {
        private static $instance = null;
        private $notices = [];
        function __construct()
        {
          add_filter('manage_find-us_posts_columns', [$this, 'addColumns']);
          add_action('manage_find-us_posts_custom_column',   [$this, 'fillColumns']);
          add_filter('manage_edit-find-us_sortable_columns', [$this, 'sortableColumns']);
          add_action('pre_get_posts', [$this, 'columnOrder']);
          add_action('admin_init', [$this, 'addLatLong']);
          add_action('admin_notices', [$this, 'addNotices']);
        }

        public function addNotices()
        {
          global $pagenow;
          $admin_pages = ['index.php', 'edit.php', 'plugins.php'];
          if (isset($_GET['post_type']) && $_GET['post_type'] == 'find-us' && is_admin()) {
            foreach ($this->notices as $notice) {
              echo '<div class="notice notice-warning is-dismissible"><p>' . $notice . '</p></div>';
            }
          }
        }


        public function addLatLong()
        {
          if (isset($_GET['updateLatLong']) && $_GET['updateLatLong'] == 1) {
            $args = array(
              'post_type'              => array('find-us'),
              'post_status'            => array('publish', ' future', ' draft', ' private', ' pending'),
              'posts_per_page'         => '-1',
            );

            $apikey = imagroup_theme_option('api_key');

            // The Query
            $query = new WP_Query($args);
            while ($query->have_posts()) :
              $query->the_post();
              $address = get_field('address');

              $geocode_response = wp_remote_get('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=' . $apikey);
              $geocode_data = json_decode(wp_remote_retrieve_body($geocode_response), true);
              $lat = $lng = null;
              if ($geocode_data['status'] === 'OK') {
                $lat = $geocode_data['results'][0]['geometry']['location']['lat'];
                $lng = $geocode_data['results'][0]['geometry']['location']['lng'];
              } else {
                $this->notices[] = "Unable to find lat/lng for the " . get_the_title();
              }
              if ($lat != null && $lng != null) {
                update_field('latitude', $lat);
                update_field('longitude', $lng);
              }
            endwhile;
          }
        }
        function addColumns($columns)
        {
          unset($columns['date']);
          $columns['latitude']  = 'Latitude';
          $columns['longitude'] = 'Longitude';
          $columns['date']      = 'Date';
          return $columns;
        }


        function fillColumns($column)
        {
          global $post;
          if ($column == 'latitude') {
            echo  get_field('latitude', $post->ID);
          }
          if ($column == 'longitude') {
            echo  get_field('longitude', $post->ID);
          }
        }


        function sortableColumns($columns)
        {
          $columns['latitude'] = 'latitude';
          $columns['longitude'] = 'longitude';
          return $columns;
        }

        function columnOrder($query)
        {
          if (!is_admin())
            return;
          $orderby = $query->get('orderby');
          if ('latitude' == $orderby) {
            $query->set('meta_key', 'latitude');
            $query->set('orderby', 'meta_value_num');
          }


          if ('longitude' == $orderby) {
            $query->set('meta_key', 'longitude');
            $query->set('orderby', 'meta_value_num');
          }
        }
        public static function getInstance()
        {
          if (self::$instance == null) {
            self::$instance == new self;
          }
          return self::$instance;
        }
      }

      $findusmangeColumns = manageFindUsColumn::getInstance();
