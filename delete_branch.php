<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "Bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$br_code = readline('Branch code: ');
// sql to delete a record
$sql = "DELETE FROM Branch WHERE branch_code='$br_code'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
$conn->close();
?> 
