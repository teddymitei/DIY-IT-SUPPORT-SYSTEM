<?php
// Start the session
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>

    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="container mt-5" style="background-color: #87CEEB; color: #000080;">

    <div class="card" style="border-color: #000080; background-color:darkturquoise">
        <div class="card-body">
            <h2 class="card-title">Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
            <p><a href="logout.php" class="btn btn-primary" style="background-color: #000080;">Logout</a></p>
        </div>
    </div>

</body>

</html>

