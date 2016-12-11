<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';
use Mailgun\Mailgun;

echo "guy";



function sendMail($email){

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
                "Content-Type: application/json"));*/

$response = curl_exec($rest);
echo $response;

}

sendMail("knightbenax@gmail.com");

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


?>
