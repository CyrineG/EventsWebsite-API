<?php
//FETCHE ALL USERS 
$message = [];
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

    // Includs database connection
    include "../db/db_connect.php";

    $query = "SELECT * FROM users";
    
    $res= $db->query($query);

    if ($res){
                http_response_code(200);
        while ($row = $res->fetchArray(SQLITE3_NUM)) {
            $user = [
             'id' => "{$row[0]}",
            'first_name' => "{$row[1]}",
            'last_name' => "{$row[2]}",
            'user_name' => "{$row[3]}",
            'admin' => "{$row[5]}"
            ];
            array_push($message, $user);     
            }
   }else{
        http_response_code(400);
        $message = ['error'=>'no users found'];
    }

echo json_encode($message);    

?>