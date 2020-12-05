<?php

$message = "";
// required headers
header("Access-Control-Allow-Origin: *");
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
        $message = "connexion avec succes";
            echo "{$row['id']} {$row['first_name']} {$row['last_name']} {$row['pwd']} \n";
            session_start();
            $_SESSION["user_name"] = $user_name;
            $_SESSION["id"] = $row['id'];
            //header('Location: home.js');
        
   }else{
        http_response_code(400);
        $message = "user not found";
    }
}
    echo $message;
  
   

?>
