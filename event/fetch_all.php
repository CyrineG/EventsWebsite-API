<?php

$message = "";
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

    // Includs database connection
    include "../db/db_connect.php";

    $query = "SELECT * FROM events";
    
    $res= $db->query($query);
    $row = $res->fetchArray();
    if($row){
        http_response_code(200);
        $message = "events retrieved successfully \n";
            echo "{$row['id']} {$row['event_name']} {$row['start_date']} {$row['end_date']} {$row['place']} {$row['description']} {$row['creator_id']} \n";
        
   }else{
        http_response_code(400);
        $message = "no events found";
    }
    echo $message;
  
   

?>
