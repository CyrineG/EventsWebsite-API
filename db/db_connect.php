<?php
// Database name
$database_name = "my_sqlite.db";
// Database Connection
$db = new SQLite3($database_name);

$query = "CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, first_name STRING, last_name STRING, user_name STRING, pwd STRING, admin BOOLEAN)";
$db->exec($query);

//create default admin
/*$query="INSERT INTO users (first_name, last_name,user_name,pwd,admin) VALUES ('admin','admin','admin', 'admin', True)";
$db->exec($query);
*/
$query = "CREATE TABLE IF NOT EXISTS events (id INTEGER PRIMARY KEY, event_name STRING, start_date DATE, end_date DATE, place STRING, description TEXT, creator_id INTEGER)";
$db->exec($query);

$query = "CREATE TABLE IF NOT EXISTS participate (
	user_id integer not null,
    event_id  integer not null,
    constraint user_id_fk foreign key (user_id) references users(id),
    constraint event_id_fk foreign key (event_id) references events(id),
    constraint participate_pk primary key (user_id, event_id)
)";
$db->exec($query);


?>

