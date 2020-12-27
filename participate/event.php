<?php
//FETCHE ALL USERS THAT ARE PARTICIPATING IN EVENT
$message = [];
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$rest_json = file_get_contents("php://input"); 
$_POST = json_decode($rest_json, true);

   if( isset($_POST['event_id']) ){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $event_id = $_POST['event_id'];

    $query = "SELECT * FROM participate WHERE event_id ='$event_id'";
    
    $res= $db->query($query);

    if ($res){
        http_response_code(200);
        while ($row = $res->fetchArray(SQLITE3_NUM)) {
            $user = [
             'user_id' => "{$row[0]}"
            ];
            array_push($message, $user);     
            }
   }else{
        http_response_code(400);
        $message = ['error'=>'no events found'];
    }
}
echo json_encode($message);    

?>
