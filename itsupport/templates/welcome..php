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
    <style>
        body {
            background-color: #f0f8ff; /* Light Blue */
            color: #000080; /* Navy Blue */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #000080; /* Navy Blue */
        }

        a {
            color: #0000cd; /* Medium Blue */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
<p><a href="logout.php">Logout</a></p>

</body>
</html>
