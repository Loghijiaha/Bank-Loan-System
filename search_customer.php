<?php

$cus_id = readline("Customer id : ");
$sql = "SELECT * FROM Customer where customer_id = '$cus_id'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["customer_id"]. " - Phone-number: " . $row["phone_number"]. " ";
    }
} else {
    echo "No customer found";
}

$db->close();
?> 
