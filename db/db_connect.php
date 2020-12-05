<?php
// Database name
$database_name = "my_sqlite.db";
// Database Connection
$db = new SQLite3($database_name);

$query = "CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, first_name STRING, last_name STRING, user_name STRING, pwd STRING, admin BOOLEAN)";
$db->exec($query);

$query = "CREATE TABLE IF NOT EXISTS events (id INTEGER PRIMARY KEY, event_name STRING, start_date DATE, end_date DATE, place STRING, description TEXT, creator_id INTEGER)";
$db->exec($query);


?>

