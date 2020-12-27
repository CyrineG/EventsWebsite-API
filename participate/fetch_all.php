<?php
//FETCHE ALL USERS THAT ARE PARTICIPATING IN EVENT
$message = [];
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

    // Includs database connection
    include "../db/db_connect.php";

    $query = "SELECT * FROM participate";
    
    $res= $db->query($query);

    if ($res){
                http_response_code(200);
        while ($row = $res->fetchArray(SQLITE3_NUM)) {
            $participate = [
             'user_id' => "{$row[0]}",
             'event_id' => "{$row[1]}"
            ];
            array_push($message, $participate);     
            }
   }else{
        http_response_code(400);
        $message = ['error'=>'no participations found'];
    }

echo json_encode($message);    

?>