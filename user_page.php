<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

   <style>
      body {
   margin: 0;
   padding: 0;
   font-family: Arial, sans-serif;
   height: 100vh;
   background: url('Victoria.png') no-repeat center center fixed;
   background-size: cover;
   position: relative;
   overflow: hidden;
}

/* Add a blurry and transparent overlay */
body::before {
   content: '';
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: rgba(0, 0, 0, 0.5); /* Transparent black */
   backdrop-filter: blur(10px);    /* Blurring effect */
   z-index: -1;                   /* Place it behind the content */
}

.sos-container {
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   display: flex;
   justify-content: center;
   align-items: center;
   width: 100%;
   height: 100%;
}

.sos-button {
   display: flex;
   justify-content: center;
   align-items: center;
   width: 100px;
   height: 100px;
   background-color: red;
   color: white;
   text-align: center;
   text-decoration: none;
   font-size: 24px;
   font-weight: bold;
   border-radius: 50%;
   border: none;
   cursor: pointer;
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
   transition: transform 0.2s;
}

.sos-button:hover {
   transform: scale(1.1);
}

.container {
   text-align: center;
   color: white;
   margin-top: 20px;
}

.btn {
   display: none; /* Hide the login and register buttons */
}

/* Style for logout button */
.logout-btn {
   position: absolute; /* Use absolute positioning */
   top: 20px;           /* Adjust to your desired distance from the top */
   right: 20px;         /* Adjust to your desired distance from the right */
   padding: 10px 20px;
   background-color: #333;
   color: white;
   text-decoration: none;
   border-radius: 5px;
   font-size: 16px;
   transition: background-color 0.3s;
   z-index: 10; /* Ensure the button stays on top of other elements */
}

.logout-btn:hover {
   background-color: red;
}
   </style>

</head>
<body>
   
<div class="container">
   <div class="content">
      <h3>Hi, <span>user</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['user_name']; ?></span></h1>
      <p>This is a user page</p>

      <!-- Circle SOS button -->
      <div class="sos-container">
         <a href="wew.php" class="sos-button">SOS</a>
      </div>

      <!-- Logout button -->
      <a href="logout.php" class="logout-btn">Logout</a>
   </div>
</div>

</body>
</html>