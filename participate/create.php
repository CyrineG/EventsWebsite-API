<?php

$message = ['error' => 'missing parameters'];
// required headers
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
$rest_json = file_get_contents("php://input"); 
$_POST = json_decode($rest_json, true);
//TO-DO kifech bich youslou les dates? in what format??
//for now i'll give direct dates bta3 today for both start w end dates

   //if( isset($_POST['event_name'])&& isset($_POST['start_date'])&& isset($_POST['end_date'])&&isset($_POST['place'])  &&isset($_POST['description']) &&isset($_POST['creator_id'])){

if( isset($_POST['event_id'])&& isset($_POST['user_id']) ){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];

    // Makes query with post data

    $query = "INSERT INTO participate (user_id, event_id) VALUES ('$user_id','$event_id')";
    // If data inserted then set success message otherwise set error message
    if( $db->exec($query) ){
        http_response_code(200);
        $message = ['success'=>'participation created successfully.'];
        
   }else{
         http_response_code(400);
        $message = ['error'=>'Error while creating participation'];
    }
}  
    echo json_encode($message); 

?>