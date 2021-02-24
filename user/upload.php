<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

move_uploaded_file($_FILES["image"]["tmp_name"], "C:\wamp64\www\EventsWebsite-API\uploads/" . $_FILES["image"]["name"]);
$photo_link = "uploads/".$_FILES["image"]["name"];
$userId = $_POST['userId'];
if( isset($_POST['userId'])){
include "../db/db_connect.php";

//$req="ALTER TABLE users ADD photo varchar(255)";
//$res=$db->exec($req);
//$sql = "UPDATE users SET photo='$photo_link' where id='$userId'";
//$resu = $db->exec($sql);

echo $photo_link;
//echo $resu;
}
?>
