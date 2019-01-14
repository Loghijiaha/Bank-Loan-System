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


$br_code = readline("Branch_code: ");
$name = readline("Name: ");
$location= readline("Location: ");
echo $br_code;

$sql = "INSERT INTO Branch (branch_code,name,location)
VALUES ('$br_code', '$name','$location')";
echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . " " . $conn->error;
}
$conn->close();
?> 
