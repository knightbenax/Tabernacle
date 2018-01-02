<?php

echo "guy";

/*function getConnection()
{
  $dbhost="localhost";
  //$dbport="8889";
  $dbuser="pzliejvn_root";
  $dbpass="kg188KzZ2n";
  $dbname="pzliejvn_ydiworld";
  $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $dbh;
}*/

function getConnection()
{
    $dbhost="127.0.0.1";
    //$dbport="8889";
    $dbuser="root";
    $dbpass="";
    $dbname="ydiworld";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

$sql = "SELECT * FROM `cj2017_participants`";
$db = getConnection();
$stmt = $db->query($sql);
$authors = $stmt->fetchAll(PDO::FETCH_OBJ);

$json_author = json_encode($authors);
$result = json_decode($json_author, true);
$result_count = count($authors);

for ($x = 0; $x < $result_count; $x++){
  //$author_id = $result[$x]["author"];

  $text0_ = $result[$x]["Fullname"];;
  $text2_ = $result[$x]["Phone"];
  $text3 = $result[$x]["Email"];
  //$text3 = "knightbenax@gmail.com";
  $this_tribe = $result[$x]["Tribe"];

  $ch = curl_init();
      // set URL and other appropriate options
      $url = "http://campjoseph.ydiworld.org/welcome_helper.php?text0=" . $text0_ . "&text2=" . $text2_ . "&this_tribe=" . $this_tribe . "&text3=" . $text3;

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, 0);

      // grab URL and pass it to the browser
      $output = curl_exec($ch);
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      // close cURL resource, and free up system resources
      curl_close($ch);
      //echo $url;
      return $output;

      echo "guy_other";
}

    
?>