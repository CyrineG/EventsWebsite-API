<?php
// Database name
$database_name = "my_sqlite.db";
// Database Connection
$db = new SQLite3($database_name);

$query = "CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, first_name STRING, last_name STRING, user_name STRING, pwd STRING, admin BOOLEAN)";
$db->exec($query);

?>

