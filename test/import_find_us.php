<?
// 'locations.2024.01.19.1153.json'
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

function convertToYesNoFromYN($value)
{
  return $value == "Y" ? "yes" : ($value == "N" ? "no" : "na");
}

function convertToYesNoFrom01($value)
{
  return $value == "1" ? "yes" : ($value == "0" ? "no" : "na");
}

function getData($jsonFile)
{
  $data = [];
  $jsonData = file_get_contents($jsonFile);
  $data = json_decode($jsonData, true);

  return $data;
}

function tryGetExistingFindUs($postTitle)
{
  $args = array(
    'post_type' => 'find-us', // Replace 'post' with the name of your post type.
    'numberposts' => -1, // To retrieve all matching posts, set this to -1.
    'title' => $postTitle,
    'tax_query' => array(
    ),
    'fields' => 'ids'
  );

  return get_posts($args);
}

function typeToTaxInt($postType)
{
  $type = -1;

  if ($postType == "Case Manager") {
    $type = 191;
  }
  if ($postType == "Provider") {
    $type = 195;
  }
  if ($postType == "site") {
    $type = 30808;
  }

  return $type;
}

function updateFindUs($post_id, $item) {
  echo "updating Find Us <br>";
  echo $item['title'];
  $zipTermId = "";
  $has_zip_code = isset($item['zip_code']) && $item['zip_code']
                  ? true
                  : false;
  if($has_zip_code) {
    $zipTerm = get_term_by('name', $item['zip_code'], 'find-us-zip-code');
    if(!$zipTerm) {
      echo "\n\tItem: " . $item['title'] . " Adding new zipcode: " . $item['zip_code'];
      $zipTerm = wp_insert_term($item['zip_code'], 'find-us-zip-code', array('slug' => $item['zip_code']));
      $zipTermId = $zipTerm['term_id'];
    }
    else {
      $zipTermId = $zipTerm->term_id;
    }
  }

  $stateTermId = "";
  $has_state = isset($item['state']) && $item['state']
                  ? true
                  : false;
  if($has_state) {
    $stateTerm = get_term_by('name', $item['state'], 'find-us-state');
    if(!$stateTerm) {
      $stateTerm = wp_insert_term($item['state'], 'find-us-state', array('slug' => $item['state']));
      $stateTermId = $stateTerm['term_id'];
    }
    else {
      $stateTermId = $stateTerm->term_id;
    }
  }
  
  update_field('field_6561d2076f778', $item['address_from_api'], $post_id);
  update_field('field_6561d21b6f779', $item['phone_number_general'], $post_id);
  update_field('field_6584a20179558', $zipTermId, $post_id);
  update_field('field_65b0ea42bc863', $item['latitude'], $post_id);
  update_field('field_65b0ea4abc864', $item['longitude'], $post_id);
  update_field('field_6584a1ba79556', $stateTermId, $post_id);
}

function createFindUs($itemTitle) {
  echo "\r\tCreating Find Us $itemTitle<br>";

  // Create a new post
  $post_id = wp_insert_post([
    'post_title'    => wp_strip_all_tags($itemTitle),
    'post_content'  => '', // You can add content if you have
    'post_status'   => 'publish',
    'post_type'     => 'find-us'
  ]);


  // Check if the post was created successfully
  if (!$post_id) {
    echo "\r\tFailed to insert Find Us: $itemTitle";
    return -1;
  }

  return $post_id;
}

function printProgress($counter, $total_rows) {
    $progress = ($counter / $total_rows) * 100;
    echo "\n\tProgress: $progress%\n";
}

function create_findus_posts_with_acf()
{
  $batch_size = 200;
  $start = 0;

  $data = getData('locations.2024.01.29.1411.json');
  $data = array_slice($data, $start, $batch_size, true);

  $total_rows = count($data);
  $counter = $start;

  foreach ($data as $item) {
    echo "item<br>";

    if ($counter % $batch_size === 0) {
      printProgress($counter, $total_rows);
      wp_cache_flush();
    }

    $postsFound = tryGetExistingFindUs($item['title']);

    $exists = count($postsFound) > 0;
    
    $postId = -1;
    if ($exists) {
      $postId = $postsFound[0];
    }
    else {
      $postId = createFindUs($item['title']);
    }

    if ($postId == -1) { continue; }

    updateFindUs($postId, $item);

    $counter++;
  }
}

create_findus_posts_with_acf();

return;
foreach ($data as $item) {
  if ($counter % $batch_size === 0) {
    $progress = ($counter / $total_rows) * 100;
    echo "\n\tProgress: $progress%\n";
    wp_cache_flush();
  }

  $makeshift_title = $item['title'];

  // Create a new post
  $post_id = wp_insert_post([
      'post_title'    => wp_strip_all_tags($makeshift_title),
      'post_content'  => '', // You can add content if you have
      'post_status'   => 'publish',
      'post_type'     => 'find-us'
  ]);

  // Check if the post was created successfully
  if (!$post_id) {
    echo "\r\tFailed to insert Find Us post: $makeshift_title";
    continue;
  }

  echo "\r\tAdding Find Us post: $counter";



  $counter++;
}