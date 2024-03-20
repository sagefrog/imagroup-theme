<?
class sf {
  public static function isDev() {
    if(isset($_SERVER["HTTP_HOST"])) {
      $http_host_arr = explode(":", $_SERVER["HTTP_HOST"]);
      $has_localhost = $http_host_arr[0] == "localhost";
      return $has_localhost;

      // // returns true when on loc, local, and wpengine
      // return ($tld == "loc" || $tld == "local") || ($domain && $domain == "wpengine"); 
    }
    return false;
  }

  public static function isLocal() {
    if(isset($_SERVER["HTTP_HOST"])) {
      $http_host_arr = explode(".", $_SERVER["HTTP_HOST"]);
      $tld = $http_host_arr[count($http_host_arr)-1];
      $domain = ((count($http_host_arr)-2 > 0) && isset($http_host_arr[count($http_host_arr)-2])) ? $http_host_arr[count($http_host_arr)-2] : false;
      // returns true when on loc and local
      return ($tld == "loc" || $tld == "local");

      // // returns true when on loc, local, and wpengine
      // return ($tld == "loc" || $tld == "local") || ($domain && $domain == "wpengine"); 
    }
    return false;
  }

  public static function isWpEngine() {
    if(isset($_SERVER["HTTP_HOST"])) {
      $http_host_arr = explode(".", $_SERVER["HTTP_HOST"]);
      $tld = $http_host_arr[count($http_host_arr)-1];
      $domain = ((count($http_host_arr)-2 > 0) && isset($http_host_arr[count($http_host_arr)-2])) ? $http_host_arr[count($http_host_arr)-2] : false;
      // // returns true when on loc and local
      // return ($tld == "loc" || $tld == "local");

      // returns true when on wpengine
      return ($domain && ($domain == "wpengine" || $domain == "sagefrog")); 
    }
    return false;
  }

  public static function splitStringNumbers($inputString = "") {
    if(exists::string($inputString))
    $parts = preg_split('/([0-9]+(?:[.,][0-9]+)*)/', $inputString, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    $results = [];

    foreach ($parts as $part) {
      if (preg_match('/^\d+(?:[.,]\d+)?$/', $part)) {
        // It's a number (including decimals and commas)
        $results[] = (object)['value' => $part, 'type' => 'number'];
      } else {
        // It's text
        $results[] = (object)['value' => $part, 'type' => 'text'];
      }
    }

    return $results;

    //  Example 1)
    //  Input => "30% increase for 50 leads"
    //  Result => [{"value":"30","type":"number"},{"value":"% increase for ","type":"text"},{"value":"50","type":"number"},{"value":" leads","type":"text"}]
    //  
    //  Example 2)
    //  Input => "30.5% increase for 50 leads"
    //  Result => [{"value":"30.5","type":"number"},{"value":"% increase for ","type":"text"},{"value":"50","type":"number"},{"value":" leads","type":"text"}]
    //
    //  Example 3)
    //  Input => "30,000,000 increase for 25 leads"
    //  Result => [{"value":"30,000,000","type":"text"},{"value":" increase for ","type":"text"},{"value":"25","type":"number"},{"value":" leads","type":"text"}]
  }
}
?>