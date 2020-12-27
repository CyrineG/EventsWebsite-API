<?php
//FETCHE ALL EVENTS THAT USER IS PARTICPATING IN
$message = [];
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$rest_json = file_get_contents("php://input"); 
$_POST = json_decode($rest_json, true);

   if( isset($_POST['user_id']) ){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $user_id = $_POST['user_id'];

    $query = "SELECT * FROM participate WHERE user_id ='$user_id'";
    
    $res= $db->query($query);

    if ($res){
        http_response_code(200);
        while ($row = $res->fetchArray(SQLITE3_NUM)) {
            $event = [
             'event_id' => "{$row[1]}"
            ];
            array_push($message, $event);     
            }
   }else{
        http_response_code(400);
        $message = ['error'=>'no events found'];
    }
}
echo json_encode($message);    

?>
