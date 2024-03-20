<?php
//  Note: This ignores State
add_action('rest_api_init', function () {
  register_rest_route('api/v2', '/locations-radius', array(
    'methods' => 'GET',
    'callback' => 'locations_radius_rest_api',
    'permission_callback' => '__return_true'  // Adjust the permission callback as needed
  ));
});

class LocationsRadius {
  public static function sanitizeRequest($request)
  {
    $requestData = [];
  
    $params = ['type', 'state', 'page', 'chained', 'requestHash', 'lat', 'lng'];
    foreach ($params as $param) {
      if ($param === 'page') {
        $requestData[$param] = intval(sanitize_text_field($request->get_param($param)));
      } 
      else if ($param === 'lat' || $param === 'lng') {
        $requestData[$param] = floatval(sanitize_text_field($request->get_param($param)));
      }
      else {
        $requestData[$param] = sanitize_text_field($request->get_param($param));
      }
    }
  
    return $requestData;
  }

  //  Input - Float lat
  //  Output - Float lngDiff
  //  distance per 1 degree longitude changes, we move along latitude, (farther from 0 towards the poles 90 / -90)
  //    as we move north/south from equator, 100 miles east requires more degrees of longitude
  //    instead of using sphere trig, lets just approximate
  public static function getLngDiff($lat) {
    $lngDiff = 1.45;

    if ($lat < 0) { $lngDiff = 1.45;}
    else if ($lat < 15) { $lngDiff = 1.5;}
    else if ($lat < 30) { $lngDiff = 1.67;}
    else if ($lat < 45) { $lngDiff = 2.04;}
    else if ($lat < 60) { $lngDiff = 2.88;}
    else if ($lat < 65) { $lngDiff = 3.41;}
    else if ($lat < 70) { $lngDiff = 4.21;}
    else if ($lat < 72) { $lngDiff = 4.65;}
    else if ($lat < 74) { $lngDiff = 5.22;}
    else if ($lat < 76) { $lngDiff = 5.94;}
    else if ($lat < 78) { $lngDiff = 6.9;}
    else if ($lat < 80) { $lngDiff = 8.24;}
    else if ($lat < 82) { $lngDiff = 10.25;}
    else if ($lat < 84) { $lngDiff = 13.53;}
    else if ($lat < 86) { $lngDiff = 19.83;}
    else if ($lat < 88) { $lngDiff = 35.78;}
    else if ($lat < 89) { $lngDiff = 55.25;}
    else if ($lat < 90) { $lngDiff = 90;}
    
    return $lngDiff;
  }

  public static function createData($requestData) {
    $result = false;
    //$radiusMiles = 100; //miles
    $latDiff = 1.6;
    $lngDiff = self::getLngDiff($requestData['lat']);
    


    // You can access parameters like this
    $posts_per_page = 800;
    $type = $requestData['type'];
    $state = $requestData['state'];
    // $zip = sanitize_text_field($request->get_param('zip'));
    $page = $requestData['page'];
    $chained = $requestData['chained'];
    $requestHash = $requestData['requestHash'];
    // ... rest of your existing logic ...
    // Prepare the query
    $search_args = [
      'post_type' => 'location',
      'posts_per_page' => $posts_per_page,
      'paged' => $page,
      'post_status' => 'publish',
      'fields' => 'ids',
      'meta_query' => [
        'relation' => 'AND',
        [
          'key' => 'latitude', //ACF FIELD NAME
          'value' => [$requestData['lat'] - $latDiff, $requestData['lat'] + $latDiff],
          'type' => 'DECIMAL',
          'compare' => 'BETWEEN'
        ],
        [
          'key' => 'longitude', //ACF FIELD NAME
          'value' => [$requestData['lng'] - $lngDiff, $requestData['lng'] + $lngDiff],
          'type' => 'DECIMAL',
          'compare' => 'BETWEEN'
        ]
      ]
    ];
  
    // Prepare tax query
    $tax_query = [];
  
    if (!empty($type)) {
      $tax_query[] = [
        'taxonomy' => 'location-type',
        'field' => 'slug',
        'terms' => $type
      ];
    }
  
    // if (!empty($state)) {
    //   $tax_query[] = [
    //     'taxonomy' => 'state',
    //     'field' => 'slug',
    //     'terms' => $state
    //   ];
    // }
  
    // if (!empty($zip)) {
    //   $tax_query[] = [
    //     'taxonomy' => 'zip',
    //     'field' => 'name',
    //     'terms' => $zip
    //   ];
    // }
  
    // Set tax query in search query
    if (count($tax_query) > 0) {
      $tax_query['relation'] = 'AND';
      $search_args['tax_query'] = $tax_query;
    }
  
    // Perform the query using WP_Query
    $locations_query = new WP_Query($search_args);
  
    $locations = [];
    $meta = [
      "max_num_pages" => $locations_query->max_num_pages,
      'chained' => $chained,
      'requestHash' => $requestHash,
      'creationMode' => 'unset',
      'latDiff' => $latDiff,
      'lngDiff' => $lngDiff,
      'lat' => $requestData['lat'],
      'lng' => $requestData['lng'],
      'latlng' => [$requestData['lat'], $requestData['lng']],
      'north' => [$requestData['lat'] + $latDiff, $requestData['lng']],
      'south' => [$requestData['lat'] - $latDiff, $requestData['lng']],
      'west' => [$requestData['lat'], $requestData['lng']-$lngDiff],
      'east' => [$requestData['lat'],  $requestData['lng']+$lngDiff]

    ];
  
    $termToPin = [];
    $termNames = [];
  
    if ($locations_query->have_posts()) {
      foreach ($locations_query->posts as $postId) {
  
        $thisTypeTermIds = get_field('type', $postId);
        $thisTypeData = array_map(
          function ($el) use (&$termToPin, &$termNames) {
            $thisTerm = get_term_by('id', $el, 'location-type');
            $thisTypeTermName = $thisTerm->name;
            if (!isset($termToPin[$el])) {
              $pin = get_field('pin', 'category_' . $el);
              if (!empty($pin)) {
                $termToPin[$el] = $pin['url'];
              }
            }
            if (!isset($termNames[$el])) {
              $termNames[$el] = $thisTypeTermName;
            }
  
            return ["id" => $el];
          },
          $thisTypeTermIds
        );
  
        //  Get State Data
        $thisStateTermId = get_field('state', $postId);
        $thisStateTerm = get_term_by('id', $thisStateTermId, 'state');
        $thisState = $thisStateTerm->name;
  
        //  Get Zipcode Data
        $thisZipcodeTermId = get_field('zip_code', $postId);
        $thisZipcodeTerm = get_term_by('id', $thisZipcodeTermId, 'zip');
        $thisZipcodeData = $thisZipcodeTerm->name;
  
        $location = (object) [
          'id' => $postId,
          // 'title' => get_the_title($postId),
          // 'address' => get_field('address_general', $postId),
          'lat' => get_field('latitude', $postId),
          'lng' => get_field('longitude', $postId),
          'types' => $thisTypeData,
          'state' => $thisState,
          'zipcode' => $thisZipcodeData
        ];
  
        $locations[] = $location;
      }
    }
  
    // Instead of echo, return the result
    if (!empty($locations)) {
      $result = [
        'locations' => $locations,
        'meta' => $meta,
        'termToPin' => $termToPin,
        'termNames' => $termNames
      ];
  
      return $result;
    } else {
      return false;
    }
    return $result;
  }
}

function locations_radius_rest_api($request)
{
  $requestData = LocationsRadius::sanitizeRequest($request);
  $result = [];

  $result = LocationsRadius::createData($requestData);

  if ($result) {
    $response =  new WP_REST_Response($result, 200);
    // $result->set_headers(array('Cache-Control' => 'max-age=600'));
  }
  else if (!$result) {
    return new WP_Error('not_found', esc_html__('We have not found any results', 'imagroup'), array('status' => 404));
  }

  return $response;
}
