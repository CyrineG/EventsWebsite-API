<?php

$message = ['error' => 'missing parameters'];
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
$rest_json = file_get_contents("php://input"); 
$_POST = json_decode($rest_json, true);

   if( isset($_POST['id'])&&isset($_POST['start_date'])&&isset($_POST['end_date']) &&isset($_POST['event_name'])&& isset($_POST['place'])  &&isset($_POST['description']) ){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $id = $_POST['id'];
    $event_name = $_POST['event_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    //$start_date = "datetime('now','localtime')";
    //$end_date = "datetime('now','localtime')";
    $place = $_POST['place'];
    $description = $_POST['description'];

    $query = "UPDATE events SET event_name='$event_name', start_date=$start_date, end_date=$end_date, place='$place', description='$description' WHERE id ='$id'";
    $res= $db->exec($query);
    if($res ){
         http_response_code(200);
        $message = ['success' => 'event updated'];
        
   }else{
        http_response_code(400);
        $message = ['error' => 'event update unsuccessful'];
    }
}
echo json_encode($message);  
?>