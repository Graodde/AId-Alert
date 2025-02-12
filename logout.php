<?php

@include 'config.php';

session_start();

// Check if a user is logged in and update their status to offline
if(isset($_SESSION['admin_name'])){
   // Assuming user_id is stored in session
   $user_id = $_SESSION['user_id']; 
   $update_status = "UPDATE user_form SET status = 'offline' WHERE id = '$user_id'";
   
   if(!mysqli_query($conn, $update_status)) {
       echo "Error updating status: " . mysqli_error($conn);
   }
}

session_unset();
session_destroy();

header('location:login_form.php');

?>