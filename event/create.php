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

if( isset($_POST['event_name'])&& isset($_POST['place'])  && isset($_POST['description']) && isset($_POST['creator_id'])){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $event_name = $_POST['event_name'];
    //$start_date = $_POST['start_date'];
    //$end_date = $_POST['end_date'];
    $start_date = "datetime('now','localtime')";
    $end_date = "datetime('now','localtime')";
    $place = $_POST['place'];
    $description = $_POST['description'];
    $creator_id = $_POST['creator_id'];

    // Makes query with post data

    $query = "INSERT INTO events (event_name, start_date, end_date, place, description, creator_id) VALUES ('$event_name',$start_date,$end_date, '$place', '$description','$creator_id')";
    // If data inserted then set success message otherwise set error message
    if( $db->exec($query) ){
        http_response_code(200);
        $message = ['success'=>'Event created successfully.'];
        
   }else{
         http_response_code(400);
        $message = ['error'=>'Error while creating event'];
    }
}  
    echo json_encode($message); 

?>