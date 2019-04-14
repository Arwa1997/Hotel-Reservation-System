<?php

session_start();

$id = $_SESSION['id'];
$approved= isset($_POST['approved']) ;
	
if (isset($_POST['approvebtn'])){
    
$sql =  "UPDATE hotel SET approved=1 WHERE id = '$id'";


if ($con->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
	

	else
		echo '$id is NOT SET ???';
}
?>