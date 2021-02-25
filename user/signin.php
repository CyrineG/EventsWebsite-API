<?php

$message = ['error' => 'missing parameters'];
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
$rest_json = file_get_contents("php://input"); 
$_POST = json_decode($rest_json, true);

   if( isset($_POST['user_name'])&&isset($_POST['pwd']) ){
    // Includs database connection
    include "../db/db_connect.php";

    // Gets the data from post
    $user_name = $_POST['user_name'];
    $pwd = $_POST['pwd'];

    // Makes query with post data
    $query = "SELECT * FROM users where user_name ='$user_name'and pwd= '$pwd' ";
    
    $res= $db->query($query);
    $row = $res->fetchArray();
    if($row){
        http_response_code(200);
        $message = [
            'id' => $row['id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'user_name'=> $row['user_name'],
            'pwd'=> $row['pwd'],
            'admin'=> $row['admin'],
            'photo'=> $row['photo']

        ];
    
        
   }else{
        http_response_code(400);
        $message = ['error'=>'user not found'];
    }
}

echo json_encode($message); 

?>
