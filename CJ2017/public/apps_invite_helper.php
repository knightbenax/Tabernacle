<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';
use Mailgun\Mailgun;

//echo "guy";



/*function sendMail($email){

  $url = "https://api.mailgun.net/v3/campjoseph.ydiworld.org/messages"

  $rest = curl_init();

  $push_payload = json_encode(array(
        "from" => "YDi Invitaion Patrol Team <malak@campjoseph.ydiworld.org>",
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

//$html  = file_get_contents('my_template.html');

# Instantiate the client.
/*$html  = file_get_contents('http://campjoseph.ydiworld.org/email.php?name=Reuben%20Ashefor&phone=08027979364&tribe=Zoe');

$mailgunApiKey = "key-835d4f7e684e51f130c623f1562e197d";
# Instantiate the client.
$client = new \GuzzleHttp\Client([
    'verify' => false,
]);

$adapter = new \Http\Adapter\Guzzle6\Client($client);
$mgClient = new \Mailgun\Mailgun($mailgunApiKey, $adapter);

//$mgClient = new Mailgun('key-835d4f7e684e51f130c623f1562e197d');
//$mgClient->setSslEnabled(false);
$domain = "campjoseph.ydiworld.org";

# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'YDi Invitaion Patrol Team <malak@campjoseph.ydiworld.org>',
    'to'      => "knightbenax@gmail.com",
    //'cc'      => 'baz@example.com',
    //'bcc'     => 'bar@example.com',
    'subject' => 'Your Camp Joseph 2016 Invite',
    'text'    => 'This is your Camp Joseph 2016 Invite. Hold it close',
    'html'    => $html//'<html>HTML version of the body</html>'
)/*, );*/

$text0 = $_GET["text0"];
$text2 = $_GET["text2"];
$this_tribe = $_GET["this_tribe"];

$text3 = $_GET["text3"];

$text0_ = urlencode($text0);
$text2_ = urlencode($text2);

$html  = file_get_contents('http://campjoseph.ydiworld.org/email.php?name=' . $text0_ . '&phone=' . $text2_ . '&tribe=' . $this_tribe);
$mailgunApiKey = "key-835d4f7e684e51f130c623f1562e197d";
# Instantiate the client.
$client = new \GuzzleHttp\Client([
    'verify' => false,
]);

$adapter = new \Http\Adapter\Guzzle6\Client($client);
$mgClient = new \Mailgun\Mailgun($mailgunApiKey, $adapter);

//$mgClient = new Mailgun('key-835d4f7e684e51f130c623f1562e197d');
//$mgClient->setSslEnabled(false);
$domain = "campjoseph.ydiworld.org";

# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'YDi <malak@campjoseph.ydiworld.org>',
    'to'      => $text3,
    //'cc'      => 'baz@example.com',
    //'bcc'     => 'bar@example.com',
    'subject' => 'Your Camp Joseph 2017 Welcome Details',
    'text'    => 'Welcome to Camp Joseph 2017. We appreciated you',
    'html'    => $html//'<html>HTML version of the body</html>'
)/*, array(
    'attachment' => array('/path/to/file.txt', '/path/to/file.txt')
)*/);

?>
