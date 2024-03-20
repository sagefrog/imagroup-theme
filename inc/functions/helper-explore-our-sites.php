<?php
add_action('rest_api_init', function () {
  register_rest_route('api/v2', '/explore-our-sites/', array(
    'methods' => 'GET',
    'callback' => 'explore_our_sites_rest_api',
    'permission_callback' => '__return_true'  // Adjust the permission callback as needed
  ));
});

function build_explore_our_sites_data($requestData)
{
  $result = false;

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
    'fields' => 'ids'
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

  if (!empty($state)) {
    $tax_query[] = [
      'taxonomy' => 'state',
      'field' => 'slug',
      'terms' => $state
    ];
  }

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
    'creationMode' => 'unset'
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
    // $result = new WP_REST_Response([
    //   'locations' => $locations,
    //   'meta' => $meta,
    //   'termToPin' => $termToPin,
    //   'termNames' => $termNames
    // ], 200);

    // Set headers.
    // $result->set_headers(array('Cache-Control' => 'max-age=600'));

    return $result;
  } else {
    return false;
  }
  return $result;
}

function sanitizeRequest($request)
{
  $requestData = [];

  $params = ['type', 'state', 'page', 'chained', 'requestHash'];
  foreach ($params as $param) {
    if ($param === 'page') {
      $requestData[$param] = intval(sanitize_text_field($request->get_param($param)));
    } else {
      $requestData[$param] = sanitize_text_field($request->get_param($param));
    }
  }
  // $requestData['type'] = sanitize_text_field($request->get_param('type'));
  // $requestData['state'] = sanitize_text_field($request->get_param('state'));
  // // $zip = sanitize_text_field($request->get_param('zip'));
  // $requestData['page'] = intval(sanitize_text_field($request->get_param('page')));
  // $requestData['chained'] = sanitize_text_field($request->get_param('chained'));
  // $requestData['requestHash'] = sanitize_text_field($request->get_param('requestHash'));

  return $requestData;
}


function createTransientKey($requestData)
{
  $transientKey =    hash('xxh32', $requestData['type'] . $requestData['state'] . $requestData['page']);

  return $transientKey ?? false;
}

function getCachedOrCreateResult($transientKey, &$requestData)
{
  $creationMode = "unset";

  //  get transient, false if doesn't exist
  $cachedResult = get_transient($transientKey);

  //  successful cache get
  if (false !== $cachedResult) {
    $result = $cachedResult;
    $creationMode = "cached";
  }
  //  build new result
  else {
    $result = build_explore_our_sites_data($requestData);
    $creationMode = "created";
    set_transient($transientKey, $result, 24 * 3600);
  }
  if (!isset($result['meta'])) {
    $result['meta'] = [];
  }
  $result['meta']['creationMode'] = $creationMode;
  $result['meta']['transientKey'] = $transientKey;

  return $result;
}

function explore_our_sites_rest_api($request)
{
  $requestData = sanitizeRequest($request);
  $result = [];

  // Cache
  $transientKey = createTransientKey($requestData);

  $cachedResult = ($transientKey)
    ? getCachedOrCreateResult($transientKey, $requestData)
    : false;

  $result = $cachedResult;

  if (false == $cachedResult) {
    $result = build_explore_our_sites_data($requestData);
    if (!isset($result['meta'])) {
      $result['meta'] = [];
    }
    $result['meta']['creationMode'] = "rudeCreation";
  }



  if ($result) {
    $response =  new WP_REST_Response($result, 200);

    // // Set headers.
    // $result->set_headers(array('Cache-Control' => 'max-age=600'));
  }

  //  return error
  else if (!$result) {
    return new WP_Error('not_found', esc_html__('We have not found any results', 'imagroup'), array('status' => 404));
  }

  return $response;
}
