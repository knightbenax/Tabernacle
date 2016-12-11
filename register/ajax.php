<?php

//require 'vendor/autoload.php';
//use Mailgun\Mailgun;

echo "guy";

function getConnection()
{
    $dbhost="XpertProCombined";
    //$dbport="8889";
    $dbuser="ydiworld";
    $dbpass="pM6CJdX!SsBvjzc";
    $dbname="ydiworld";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

if(isset($_POST["Code"])){
  register();
}
/*function getConnection()
{
    $dbhost="127.0.0.1";
    //$dbport="8889";
    $dbuser="root";
    $dbpass="";
    $dbname="ydiworld";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}*/

/*function randomDigits($length){
    $digits = 0;
    $numbers = range(0,9);
    shuffle($numbers);
    for($i = 0;$i < $length;$i++)
      $digits = $numbers[$i];
       //$digits .= $numbers[$i];
    return $digits;
}*/

function register(){
  $tribes = array("Zion", "Zoe", "Rhema", "Shalom", "Agape", "Charis", "Trinitas", "Dunamis", "Shabach", "Shekinah");
  $tribe_count = 0;

  $text0 = $_POST["text0"];
  $text1 = $_POST["text1"];
  $text2 = $_POST["text2"];
  $text3 = $_POST["text3"];
  $text4 = $_POST["text4"];
  $text5 = $_POST["text5"];
  $text6 = $_POST["text6"];

  $sql = "INSERT INTO `cj2016_participants`(`Fullname`, `Phone`, `Email`, `Hear about Camp`, `Career`, `First time at Camp`, `Date Registered`, `Tribe`, `Gender`) VALUES (:fullname, :phone, :email, :hearaboutcamp, :career, :firsttime, CURRENT_TIMESTAMP, :tribe, :gender)";
  //$sql = "INSERT INTO `bibleschool` (`ID`, `Name`, `Date Of Birth`, `Address`, `Email`, `GSM Phone Number`, `Home Phone Number`, `Gender`, `Marital Status`, `How Long Married`, `Number Of Children`, `Born Again`, `Salvation Experience`, `Church Name`, `Church Address`, `Period Attending Church`, `Church Worker`, `Unit/Department`, `Cordial Relationship With Pastor`, `Senior Pastor`, `Call Of God On Your LIfe`, `Type Of Call`, `School/College`, `Educational Qualifications`, `Programme Type Applied For`, `How Did You Hear About GHBS`, `Decision To Apply To GHBS`, `Health Challenges`, `Physical Challenges`, `Expectations`, `Passport`) VALUES (:text0, :text1, :text2, :text3, :text4, :text5, :text6, :text7, :text8, :text9, :text10, :text11, :text12, :text13, :text14, :text15, :text16, :text17, :text18, :text19, :text20, :text21, :text22, :text23, :text24, :text25, :text26, :text27, :text28, :text29)";
  try{

      $this_tribe = $tribes[mt_rand(0, 9)];

      $db = getConnection();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":fullname", $text0);
      $stmt->bindParam(":gender", $text1);
      $stmt->bindParam(":phone", $text2);
      $stmt->bindParam(":email", $text3);
      $stmt->bindParam(":hearaboutcamp", $text4);
      $stmt->bindParam(":career", $text5);
      $stmt->bindParam(":firsttime", $text6);
      $stmt->bindParam(":tribe", $this_tribe);

      $stmt->execute();

      $text0_ = urlencode($text0);
      $text2_ = urlencode($text2);

      $ch = curl_init();
      // set URL and other appropriate options
      $url = "http://campjoseph.ydiworld.org/invite_helper.php?text0=" . $text0_ . "&text2=" . $text2_ . "&this_tribe=" . $this_tribe . "&text3=" . $text3;

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, 0);

      // grab URL and pass it to the browser
      $output = curl_exec($ch);
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      // close cURL resource, and free up system resources
      curl_close($ch);
      //echo $url;
      return $output;

      //sendMail($text2);
      //echo json_encode($users);
      //$resp = array('status' => "success");
      //$resp = array('status' => "success", 'Version' => "1.0");
      //echo  json_encode($resp) ;
  }catch(PDOException $e){
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}
/*
function sendMail($email){
$html  = file_get_contents('my_template.html');

# Instantiate the client.
$mgClient = new Mailgun('key-835d4f7e684e51f130c623f1562e197d');
$domain = "cj2016.ydiworld.org";

# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'YDi Invitaion Patrol Team <malak@cj2016.ydiworld.org>',
    'to'      => $email,
    //'cc'      => 'baz@example.com',
    //'bcc'     => 'bar@example.com',
    'subject' => 'Your Camp Joseph 2016 Invite',
    'text'    => 'This is your Camp Joseph 2016 Invite. Hold it close',
    'html'    => '<html>HTML version of the body</html>'
);, array(
    'attachment' => array('/path/to/file.txt', '/path/to/file.txt')
)
}*/

/*function sendMail($email){

  $url = "https://api.mailgun.net/v3/cj2016.ydiworld.org/messages"

  $rest = curl_init();

  $push_payload = json_encode(array(
        "from" => "YDi Invitaion Patrol Team <malak@cj2016.ydiworld.org>",
        "to" => $email,
        "subject" => "Your Camp Joseph 2016 Invite",
        "text" => "This is your Camp Joseph 2016 Invite. Hold it close",
        "html" => '<html>HTML version of the body</html>'
));

curl_setopt($rest,CURLOPT_URL,$url);
curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);
curl_setopt($rest,CURLOPT_POST,1);
curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($rest,CURLOPT_POSTFIELDS,$push_payload);
curl_setopt($ch, CURLOPT_USERPWD, "api" . ":" . "key-835d4f7e684e51f130c623f1562e197d");
/*curl_setopt($rest,CURLOPT_HTTPHEADER,
        array("api:key=" . $restKey,
                "Content-Type: application/json"));

$response = curl_exec($rest);
echo $response;

}*/



?>
