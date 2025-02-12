<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

// Fetch user data
$select = "SELECT * FROM user_form";
$result = mysqli_query($conn, $select);
if(!$result) {
   die("Query failed: " . mysqli_error($conn));
}

if(isset($_GET['action']) && isset($_GET['id'])){
   $action = $_GET['action'];
   $user_id = intval($_GET['id']); // Sanitizing input

   if($action == 'delete'){
      $delete = "DELETE FROM user_form WHERE id = '$user_id'";
      if(mysqli_query($conn, $delete)) {
         header('location:admin_page.php');
      } else {
         echo "Error deleting record: " . mysqli_error($conn);
      }
   }

   if($action == 'activate'){
      $update = "UPDATE user_form SET status = 'active' WHERE id = '$user_id'";
      if(mysqli_query($conn, $update)) {
         header('location:admin_page.php');
      } else {
         echo "Error updating record: " . mysqli_error($conn);
      }
   }

   if($action == 'deactivate'){
      $update = "UPDATE user_form SET status = 'offline' WHERE id = '$user_id'";
      if(mysqli_query($conn, $update)) {
         header('location:admin_page.php');
      } else {
         echo "Error updating record: " . mysqli_error($conn);
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <div class="container-fluid">
      <a class="navbar-brand" href="#">Admin Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="admin_page.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
         </ul>
      </div>
   </div>
</nav>

<div class="container mt-4">
   <h3 class="text-center">Welcome, <span class="text-primary"><?php echo $_SESSION['admin_name']; ?></span></h3>
   <h1 class="text-center">Manage User Accounts</h1>
   
   <div class="table-responsive">
      <table class="table table-bordered table-striped mt-3">
         <thead class="table-dark">
            <tr>
               <th>Name</th>
               <th>Email</th>
               <th>Status</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
               <td><?php echo $row['name']; ?></td>
               <td><?php echo $row['email']; ?></td>
               <td>
                  <span class="badge <?php echo $row['status'] == 'active' ? 'bg-success' : 'bg-secondary'; ?>">
                     <?php echo ucfirst($row['status']); ?>
                  </span>
               </td>
               <td>
                  <a href="?action=activate&id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Activate</a>
                  <a href="?action=deactivate&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Deactivate</a>
                  <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
               </td>
            </tr>
            <?php endwhile; ?>
         </tbody>
      </table>
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>