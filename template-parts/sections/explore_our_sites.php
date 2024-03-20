<?php

$status = get_sub_field('section_display_status');

$id = get_sub_field('section_id');
$extra_class = get_sub_field('section_extra_class');

if ($status !== 'show') {
  return;
}
$DefaultTerm = "Site";

$heading_content = get_sub_field('explore_our_sites_heading_content'); ?>
<?
  if(!function_exists('createStateOptions')):
    function createStateOptions($typeTerms) {
      $stateOptions = [];
      foreach ($typeTerms as $typeTerm) :
        $args = array(
          'post_type' => 'location', // Replace with your custom post type
          'posts_per_page' => -1, // Retrieve all posts
          'tax_query' => array(
            array(
              'taxonomy' => 'location-type', // Your Type taxonomy
              'field'    => 'slug',
              'terms'    => $typeTerm->slug,
            ),
          ),
          'fields' => 'ids'
        );


        $postIds = get_posts($args);
        foreach ($postIds as $postId) {
          $post_states = wp_get_post_terms($postId, 'state'); // Replace 'state' with your State taxonomy
          foreach ($post_states as $stateTerm) {
            if(!isset($stateOptions[$stateTerm->term_id])) {
              $stateOptions[$stateTerm->term_id] = (object)[
                "slug"=>$stateTerm->slug,
                "name"=>$stateTerm->name,
                "typeSlugs"=>[]
              ];
            }
            if(!in_array($typeTerm->slug, $stateOptions[$stateTerm->term_id]->typeSlugs)) {
              $stateOptions[$stateTerm->term_id]->typeSlugs[] = $typeTerm->slug;
            }
          }
        }
      endforeach;

      usort($stateOptions, function($a, $b) {
        return strcmp($a->name, $b->name);
      });

      return $stateOptions;
    }
  endif;
  if(!function_exists('getStateOptions')):
    function getStateOptions($typeTerms) {
        $transientKey = 'getStateOptions_'.hash('xxh32', 'getStateOptions');
        //  get transient, false if doesn't exist
        $result = get_transient($transientKey);
        //  successful cache get
        if (false !== $result) {
          return $result;
        }
        //  build new result
        else {
          $result = createStateOptions($typeTerms);
          set_transient($transientKey, $result, 24 * 3600);
        }
    }
  endif;
?>
<section <?php imagroup_section_id($id); ?> class="contact-banner explore_our_sites pt-md-90 pb-md-20 pt-60 banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/contact-banner.png" <?php echo esc_attr($extra_class); ?>>
  <div class="contact-banner-mobile banner-bg" data-background="<?php echo IMAGE_ASSETS_URL; ?>/contact-banner-mobile.png"></div>
  <div class="container">
    <?php
    if (!empty($heading_content)):
    ?>
      <div class="content-title body-xl text-center max-width-675 mb-30 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
        <?php echo imagroup_remove_empty_p(wpautop($heading_content)); ?>
      </div>
    <?php
    endif;
    ?>

    <?
    $googlemap_api_key = imagroup_theme_option('api_key');
    ?>
    <script>
    (function(maps, undefined){
      maps.apikey = "<?=$googlemap_api_key?>";
    }(window.maps = window.maps || {}));
    </script>
    <script>
      (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
        key: "<?=$googlemap_api_key?>",
        v: "weekly",
        // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
        // Add other bootstrap parameters as needed, using camel case.
      });
    </script>
    <link rel="stylesheet" href="<?=get_template_directory_uri() . '/template-parts/sections/explore_our_sites/eos.css'?>">
            <?php
            $typeTerms = [];
            $type = get_terms(array('taxonomy' => 'location-type'));
            if (!empty($type)):
              foreach ($type as $term): ?>
              <?$typeTerms[] = (object)["name"=>$term->name, "slug"=>$term->slug];?>
            <?php
              endforeach;
            endif;
            ?>
    <form name="explore-our-sites" method="post">
      <div class="map-filter-row mb-md-40 mb-50 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
        <label>
          <?php echo esc_html__('Filter Locations', 'imagroup'); ?></label>
        <div class="map-filter-form">
          <select name="type" class="selectpicker form-control" title="<?php echo esc_html__('Type', 'imagroup'); ?>" data-selected-text-format="count > 1" aria-label="<?php echo esc_html__('Type', 'imagroup'); ?>" data-live-search="false">
            <option value="">
              <?php echo esc_html__('All', 'imagroup'); ?></option>
              
            <?
              foreach ($typeTerms as $term):
            ?>
            <option 
              value="<?php echo esc_attr($term->slug); ?>"
              <?
                if($term->name == $DefaultTerm) {
                  echo "selected";
                }
              ?>
            >
              <?php echo $term->name; ?>
            </option>
            <?
            endforeach;
            ?>
          </select>
          <?
          $stateOptions = getStateOptions($typeTerms);
          // //  Get States per Term
          // $stateOptions = [];
          // foreach ($typeTerms as $typeTerm) :
          //   $args = array(
          //     'post_type' => 'location', // Replace with your custom post type
          //     'posts_per_page' => -1, // Retrieve all posts
          //     'tax_query' => array(
          //       array(
          //         'taxonomy' => 'location-type', // Your Type taxonomy
          //         'field'    => 'slug',
          //         'terms'    => $typeTerm->slug,
          //       ),
          //     ),
          //     'fields' => 'ids'
          //   );


          //   $postIds = get_posts($args);
          //   foreach ($postIds as $postId) {
          //     $post_states = wp_get_post_terms($postId, 'state'); // Replace 'state' with your State taxonomy
          //     foreach ($post_states as $stateTerm) {
          //       if(!isset($stateOptions[$stateTerm->term_id])) {
          //         $stateOptions[$stateTerm->term_id] = (object)[
          //           "slug"=>$stateTerm->slug,
          //           "name"=>$stateTerm->name,
          //           "typeSlugs"=>[]
          //         ];
          //       }
          //       if(!in_array($typeTerm->slug, $stateOptions[$stateTerm->term_id]->typeSlugs)) {
          //         $stateOptions[$stateTerm->term_id]->typeSlugs[] = $typeTerm->slug;
          //       }
          //     }
          //   }
          // endforeach;

          // usort($stateOptions, function($a, $b) {
          //   return strcmp($a->name, $b->name);
          // })
          ?>
          <select name="state" class="selectpicker form-control" title="<?php echo esc_html__('State', 'imagroup'); ?>" data-selected-text-format="count > 1" aria-label="<?php echo esc_html__('State', 'imagroup'); ?>" data-live-search="false">
            <option value="" data-typeSlugs="<?=implode(",",array_column($typeTerms, 'slug'))?>">
              <?php echo esc_html__('All', 'imagroup'); ?></option>
            <?php
            $state = get_terms(array('taxonomy' => 'state'));
            if (!empty($state)) {
              foreach ($stateOptions as $stateOption) { ?>
                <option 
                  value="<?php echo esc_attr($stateOption->slug); ?>"
                  <?
                      echo "data-typeSlugs=".implode(",",$stateOption->typeSlugs);
                  ?>
                  <?
                    if(!in_array(strtolower($DefaultTerm),$stateOption->typeSlugs)):
                      echo "disabled";
                    endif;
                  ?>
                >
                  <?= $stateOption->name ?>
                </option>
            <?php
              }
            } ?>
          </select>
          <input type="text" name="zip" maxlength="5" placeholder="<?php echo esc_html__('Zip', 'imagroup'); ?>">
          <input type="hidden" name="action" value="explore_our_sites_ajax">
          <button type="submit" class="btn btn2 submit-btn">
            <?php echo esc_html__('search', 'imagroup'); ?></button>
        </div>
      </div>
    </form>
    <?php
    // if( !wp_is_mobile() ): 
    ?>
    <div class="minimize-me-to-0" style="position: absolute; opacity: 0; width: 7px; height: 3px; background-color:green;z-index:999999999999999; transform: translateY(20px);transition: 0.5s all ease-out;"></div>
    <script>
      window.addEventListener('load', () => {
        setTimeout(() => {
          [...document.querySelectorAll('.minimize-me-to-0')].forEach(el => {
            let transition = el.style.transition;
            el.style.transform = 'translateY(-3px)';
            el.style.transition = 'unset';
            el.style.transition = 'unset';
            el.style.opacity = 0.5;
            el.style.transition = 'all 0.5s ease 0s';
            el.style.opacity = 1;
          });
        }, 300);
        setTimeout(() => {
          [...document.querySelectorAll('.minimize-me-to-0')].forEach(el => {
            el.style.width = 0;
            el.style.height = 0;
            el.style.transform = 'translateY(0px)';
          });
        }, 2000);
      })
    </script>
    <div class="map-location d-sm-block d-md-block wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s" style="overflow:hidden; position: relative;">
      <div id="explore-our-sites-map"></div>
      <!-- <div id="imagroup-map-loading" style="position:absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 50; ">
        <div class="mapPlaceholder">
          <div class="loader-ripple">
            <div></div>
            <div></div>
          </div>
        </div>
      </div> -->
    </div>
    <?php
    // endif;
    ?>
  </div>
</section>
<section class="content-part">
  <div class="map-location-flag wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="0.5s">
    <?php
    $type = get_terms(array('taxonomy' => 'location-type'));
    if (!empty($type)) {
      foreach ($type as $term) {
        $pin = get_field('pin', 'category_' . $term->term_id); ?>
        <div class="map-location-flag-item">
          <?php
          if (!empty($pin)) { ?>
            <img src="<?php echo esc_url($pin['url']); ?>" alt="<?php echo esc_attr($pin['alt']); ?>">
          <?php
          }
          echo $term->name; ?>
        </div>
    <?php
      }
    } ?>
  </div>
  <?php
  // if( wp_is_mobile() ): 
  ?>
</section>
<?php
// endif;
?>