<?php

$message = ['error' => 'missing parameters'];
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
$rest_json = file_get_contents("php://input"); 
$_POST = json_decode($rest_json, true);

   if( isset($_POST['id']) ){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $id = $_POST['id'];

    //delete participations with event first
    $query = "DELETE FROM participate WHERE event_id ='$id' ";

    if($db->query($query) ){
        http_response_code(200);
        $message = ['success' => 'participation deleted'
        ];
        
   }else{
        http_response_code(400);
        $message = ['error' => 'delete unsuccessful'];
    }
    //delete event
    $query = "DELETE FROM events WHERE id ='$id'";

    if($db->query($query) ){
        http_response_code(200);
        $message = ['success' => 'event deleted'
        ];
        
   }else{
        http_response_code(400);
        $message = ['error' => 'delete unsuccessful'];
    }
}
    echo json_encode($message); 
?>