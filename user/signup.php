<?php

$message = ['error' => 'missing parameters'];
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
$rest_json = file_get_contents("php://input"); 
$_POST = json_decode($rest_json, true);
   if( isset($_POST['first_name'])&& isset($_POST['last_name'])&& isset($_POST['user_name'])&&isset($_POST['pwd']) ){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_name = $_POST['user_name'];
    $pwd = $_POST['pwd'];

    // Makes query with post data

    $query = "INSERT INTO users (first_name, last_name,user_name,pwd,admin) VALUES ('$first_name','$last_name','$user_name', '$pwd', False)";
    // If data inserted then set success message otherwise set error message
    if( $db->exec($query) ){
        http_response_code(200);
        $message = ['success'=>'Data inserted successfully.'];
        
   }else{
        http_response_code(400);
        $message = ['error'=>'failure to create new user.'];
    }
 
}  
echo json_encode($message);     
//zid erreur
?>
