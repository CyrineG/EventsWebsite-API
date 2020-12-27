<?php

$message = ['error' => 'missing parameters'];
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$rest_json = file_get_contents("php://input"); 
$_POST = json_decode($rest_json, true);

   if( isset($_POST['user_id']) && isset($_POST['event_id']) ){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];

    $query = "DELETE FROM participate WHERE event_id ='$event_id' and user_id='$user_id' ";

    if($db->query($query) ){
        http_response_code(200);
        $message = ['success' => 'participation deleted'
        ];
        
   }else{
        http_response_code(400);
        $message = ['error' => 'delete unsuccessful'];
    }
}
    echo json_encode($message); 
?>