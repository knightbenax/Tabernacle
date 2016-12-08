<?php

/*function getConnection()
{
    $dbhost="XpertProCombined";
    //$dbport="8889";
    $dbuser="greathouse";
    $dbpass="Great101-";
    $dbname="greathouse";
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

function randomDigits($length){
    $numbers = range(0,9);
    shuffle($numbers);
    for($i = 0;$i < $length;$i++)
       $digits .= $numbers[$i];
    return $digits;
}

$tribes = array("Zion", "Zoe", "Rhema", "Shalom", "Agape", "Charis", "Trinitas", "Dunamis", "Shabach", "Shekinah");
$tribe_count = 0;

$text0 = $_POST["text0"];
$text1 = $_POST["text1"];
$text2 = $_POST["text2"];
$text3 = $_POST["text3"];
$text4 = $_POST["text4"];
$text5 = $_POST["text5"];

$sql = "INSERT INTO `cj2016_participants`(`Fullname`, `Phone`, `Email`, `Hear about Camp?`, `Career`, `First time at Camp?`, `Date Registered`, `Tribe`) VALUES (:fullname,:phone,:email,:hearaboutcamp,:career,:firsttime, CURRENT_TIMESTAMP, :tribe)";
//$sql = "INSERT INTO `bibleschool` (`ID`, `Name`, `Date Of Birth`, `Address`, `Email`, `GSM Phone Number`, `Home Phone Number`, `Gender`, `Marital Status`, `How Long Married`, `Number Of Children`, `Born Again`, `Salvation Experience`, `Church Name`, `Church Address`, `Period Attending Church`, `Church Worker`, `Unit/Department`, `Cordial Relationship With Pastor`, `Senior Pastor`, `Call Of God On Your LIfe`, `Type Of Call`, `School/College`, `Educational Qualifications`, `Programme Type Applied For`, `How Did You Hear About GHBS`, `Decision To Apply To GHBS`, `Health Challenges`, `Physical Challenges`, `Expectations`, `Passport`) VALUES (:text0, :text1, :text2, :text3, :text4, :text5, :text6, :text7, :text8, :text9, :text10, :text11, :text12, :text13, :text14, :text15, :text16, :text17, :text18, :text19, :text20, :text21, :text22, :text23, :text24, :text25, :text26, :text27, :text28, :text29)";
try{

    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":fullname", $text0);
    $stmt->bindParam(":phone", $text1);
    $stmt->bindParam(":email", $text2);
    $stmt->bindParam(":hearaboutcamp", $text3);
    $stmt->bindParam(":career", $text4);
    $stmt->bindParam(":firsttime", $text5);

    $this_tribe = $tribes[randomDigits(9)];

    $stmt->bindParam(":tribe", $this_tribe);

    $stmt->execute();
    //echo json_encode($users);
    //$resp = array('status' => "success");
    //$resp = array('status' => "success", 'Version' => "1.0");
    //echo  json_encode($resp) ;
}catch(PDOException $e){
    echo '{"error":{"text":'. $e->getMessage() .'}}';
}



?>
