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
    <title>Welcome</title>
</head>
<body>

<h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
<p><a href="logout.php">Logout</a></p>

</body>
</html>
