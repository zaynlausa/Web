<?php
$host = 'localhost';
$dbname = 'ActivityPHP';
$user = 'postgres';
$dbpwd = 'lausa2004';

// Connect to PostgreSQL database
$db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $dbpwd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>