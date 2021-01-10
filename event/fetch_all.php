<?php

$message = [];
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

    // Includs database connection
    include "../db/db_connect.php";

    $query = "SELECT * FROM events";
    
    $res= $db->query($query);

    if ($res){
                http_response_code(200);
        while ($row = $res->fetchArray(SQLITE3_NUM)) {
            $event = [
             'id' => "{$row[0]}",
             'event_name' => "{$row[1]}",
             'start_date' => "{$row[2]}",
             'end_date' => "{$row[3]}",
             'place' => "{$row[4]}",
             'description' => "{$row[5]}",
             'creator_id' => "{$row[6]}"
            ];
            array_push($message, $event);     
            }
   }else{
        http_response_code(400);
        $message = ['error'=>'no events found'];
    }
echo json_encode($message);    

?>
