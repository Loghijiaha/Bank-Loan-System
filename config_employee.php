<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'employee');
   define('DB_PASSWORD', 'employee');
   define('DB_DATABASE', 'Bank');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
	}
?>
