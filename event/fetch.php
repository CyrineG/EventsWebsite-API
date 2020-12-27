<?php

$message = ['error' => 'missing parameters'];
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$rest_json = file_get_contents("php://input"); 
$_POST = json_decode($rest_json, true);

   if( isset($_POST['id']) ){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $id = $_POST['id'];

    $query = "SELECT * FROM events WHERE id ='$id'";
    
    $res= $db->query($query);
    $row = $res->fetchArray();
    if($row){
        http_response_code(200);
        $message = [
         'id' => $row['id'],
         'event_name' => $row['event_name'],
         'start_date' => $row['start_date'],
         'end_date' => $row['end_date'],
         'place' => $row['place'],
         'description' => $row['description'],
         'creator_id' => $row['creator_id']
        ];
        
   }else{
        http_response_code(400);
        $message = ['error' => 'no events found'];
    }
}
    echo json_encode($message); 
?>