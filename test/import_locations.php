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

function tryGetExistingLocation($postTitle, $typeTermId)
{
  $args = array(
    'post_type' => 'location', // Replace 'post' with the name of your post type.
    'numberposts' => -1, // To retrieve all matching posts, set this to -1.
    'title' => $postTitle,
    'tax_query' => array(
      array(
        'taxonomy' => 'location-type', // Replace 'your_taxonomy_name' with the name of your taxonomy.
        'field'    => 'term_id', // Use 'term_id' to query by term ID.
        'terms'    => $typeTermId, // Use the $term_id variable here.
      ),
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

function updateLocation($post_id, $itemType, $item) {
  echo "updating Location <br>";
  echo $item['title'];
  $zipTermId = "";
  $has_zip_code = isset($item['zip_code']) && $item['zip_code']
    ? true
    : false;
  if ($has_zip_code) {
    $zipTerm = get_term_by('name', $item['zip_code'], 'zip');
    if (!$zipTerm) {
      echo "\n\tItem: " . $item['title'] . " Adding new zipcode: " . $item['zip_code'];
      $zipTerm = wp_insert_term($item['zip_code'], 'zip', array('slug' => $item['zip_code']));
      $zipTermId = $zipTerm['term_id'];
    } else {
      $zipTermId = $zipTerm->term_id;
    }
  }

  $stateTermId = "";
  $has_state = isset($item['state']) && $item['state']
    ? true
    : false;
  if ($has_state) {
    $stateTerm = get_term_by('name', $item['state'], 'state');
    if (!$stateTerm) {
      $stateTerm = wp_insert_term($item['state'], 'state', array('slug' => $item['state']));
      $stateTermId = $stateTerm['term_id'];
    } else {
      $stateTermId = $stateTerm->term_id;
    }
  }

  update_field('field_65789210729e6', $itemType, $post_id);
  update_field('field_6561ca1a1ddd4', $item['latitude'], $post_id);
  update_field('field_6561ca261ddd5', $item['longitude'], $post_id);
  update_field('field_6561c36eec45b', $item['address_from_api'], $post_id);
  update_field('field_657890615fa6c', $zipTermId, $post_id);
  update_field('field_6578b56a9b27e', $stateTermId, $post_id);
  update_field('field_6561c4afb2071', $item['phone_number_general'], $post_id);
}

function createLocation($itemTitle) {
  echo "\r\tCreating Location $itemTitle<br>";

  // Create a new post
  $post_id = wp_insert_post([
    'post_title'    => wp_strip_all_tags($itemTitle),
    'post_content'  => '', // You can add content if you have
    'post_status'   => 'publish',
    'post_type'     => 'location'
  ]);


  // Check if the post was created successfully
  if (!$post_id) {
    echo "\r\tFailed to insert location: $itemTitle";
    return -1;
  }

  return $post_id;
}

function printProgress($counter, $total_rows) {
    $progress = ($counter / $total_rows) * 100;
    echo "\n\tProgress: $progress%\n";
}

function create_custom_posts_with_acf()
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

    $itemType = typeToTaxInt($item['type']);

    $postsFound = tryGetExistingLocation($item['title'], $itemType);

    $exists = count($postsFound) > 0;
    
    $postId = -1;
    if ($exists) {
      $postId = $postsFound[0];
    }
    else {
      $postId = createLocation($item['title']);
    }

    if ($postId == -1) { continue; }

    updateLocation($postId, $itemType, $item);

    $counter++;
  }
}

create_custom_posts_with_acf();
