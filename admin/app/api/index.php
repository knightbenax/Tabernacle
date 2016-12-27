<?php
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('UTC');

try {
    // Initialize Composer autoloader
    if (!file_exists($autoload = __DIR__ . '/vendor/autoload.php')) {
        throw new \Exception('Composer dependencies not installed. Run `make install --directory app/api`');
    }
    require_once $autoload;

    // Initialize Slim Framework
    if (!class_exists('\\Slim\\Slim')) {
        throw new \Exception(
            'Missing Slim from Composer dependencies.'
            . ' Ensure slim/slim is in composer.json and run `make update --directory app/api`'
        );
    }

    // Run application
    $app = new \Api\Application();
    $app->get('/signups', 'getUsers');
    $app->get('/first_timer_signups', 'getNewSignupsCount');
    $app->get('/signups_data', 'getGraphData');
    $app->post('/do_search', 'search');
    $app->post('/mark_arrived', 'markAsArrived');
    $app->get('/arrivals', 'getArrivals');
    $app->run();




} catch (\Exception $e) {
    if (isset($app)) {
        $app->handleException($e);
    } else {
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(array(
            'status' => 500,
            'statusText' => 'Internal Server Error',
            'description' => $e->getMessage(),
        ));
    }
}

/*function getConnection()
{
    $dbhost="XpertProCombined";
    //$dbport="8889";
    $dbuser="ydiworld";
    $dbpass="pM6CJdX!SsBvjzc";
    $dbname="ydiworld";
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


function getUsers(){
    $sql = "SELECT *, UNIX_TIMESTAMP(`Date Registered`) AS epoch_time FROM cj2016_participants ORDER BY `Fullname` ASC";
    try{
        $db = getConnection();
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($users);
    }catch(PDOException $e){
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function getArrivals(){
    $sql = "SELECT COUNT(*) FROM cj2016_participants WHERE `Status` = 'Arrived'";
    try{
        $db = getConnection();
        $stmt = $db->query($sql);
        $users = $stmt->fetch(PDO::FETCH_NUM);
        $db = null;
        echo $users[0];
    }catch(PDOException $e){
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function markAsArrived(){
    $id = $_POST["ID"];
    $sql = "UPDATE `cj2016_participants` SET `Status` = 'Arrived' WHERE ID = $id";
    try{
        $db = getConnection();
        $stmt = $db->query($sql);
        //$users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //echo json_encode($users);
    }catch(PDOException $e){
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function search(){
    $query = $_POST["search"];

    if ($query == ""){
      getUsers();
    } else {
      $query_like = "%" . $query . "%";

      try{
        $db = getConnection();

        $stmt = $db->prepare("(SELECT *, UNIX_TIMESTAMP(`Date Registered`) AS epoch_time
        FROM `cj2016_participants` AS `rel`
        WHERE MATCH (`Fullname`, `Phone`, `Email`, `Hear about Camp`, `Career`, `First time at Camp`, `Tribe`, `Gender`) AGAINST ('$query' IN BOOLEAN MODE) ORDER BY 'rel' DESC, Fullname ASC) UNION (SELECT *, UNIX_TIMESTAMP(`Date Registered`) AS epoch_time FROM cj2016_participants WHERE `Date Registered` LIKE '$query_like' ORDER BY Fullname ASC)");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $downs = $stmt->fetchAll(PDO::FETCH_OBJ);
        //if(sizeof($downs)>0){
            echo json_encode($downs);
        //}else{
          //getUsers();
        //}
      }catch(PDOException $e){
          echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
    }


}


function getNewSignupsCount(){
    $sql = "SELECT COUNT(*) FROM cj2016_participants WHERE (`First time at Camp` = 'Yes') OR (`First time at Camp` = 'yes' AND `First time at Camp` LIKE '%first%' AND `First time at Camp` LIKE '%yes%' AND `First time at Camp` LIKE 'Yes%' AND `First time at Camp` LIKE 'yes%' AND `First time at Camp` LIKE 'first%')";
    try{
        $db = getConnection();
        $stmt = $db->query($sql);
        $users = $stmt->fetch(PDO::FETCH_NUM);
        $db = null;
        echo $users[0];
    }catch(PDOException $e){
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getGraphData(){
    $sql = "SELECT *, UNIX_TIMESTAMP(`Date Registered`) AS epoch_time FROM cj2016_participants ORDER BY `Date Registered` ASC";
    try{
        $db = getConnection();
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        $value = "[";

        $json_users = json_encode($users);
        $result = json_decode($json_users, true);
        $result_count = count($result);

        $temp_for_date = null;

        for ($x = 0; $x < $result_count; $x++){
          $this_date = $result[$x]["epoch_time"];

          $for_date = date('Y-m-d', $this_date);

          $sexy_date = date('Y-m-d', $this_date); //d M Y

          if ($for_date != $temp_for_date){

            $temp_for_date = $for_date;

            $for_date = $for_date . '%';

            $sql_ = "SELECT COUNT(*) FROM cj2016_participants WHERE `Date Registered` LIKE '$for_date'";

            $db_ = getConnection();
            $stmt_ = $db_->query($sql_);
            //$users_ = $stmt_->fetchAll(PDO::FETCH_OBJ);
            $users_ = $stmt_->fetch(PDO::FETCH_NUM);
            //$users_ = $stmt_->rowCount();

            //$value = $value . $users_;
            //print_r($for_date);

            $this_value = '{ "date": "' . $sexy_date . '", "signups": "' .$users_[0] . '" },';

            $value = $value . $this_value;
            //print_r(json_encode($users_));
            //print_r(var_dump($users_));
            //$array_result = json_encode($users_);

            //echo "<br>";

          }



        }



        //echo rtrim($value, ",");

        $value_new = substr_replace($value ,"",-1);;

        $value = $value_new . "]";

        //$value_new_ = json_encode($value);

        print_r($value);

        //print_r($value);
        //echo json_encode($value);
        //echo $value;


        //echo json_encode($users);
    }catch(PDOException $e){
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
