<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "bsod_db";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to verify user credentials
function authenticateUser($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $hashed_password)) {
        return true; // Authentication successful
    }

    return false; // Authentication failed
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_input = $_POST["username"];
    $password_input = $_POST["password"];

    if (authenticateUser($conn, $username_input, $password_input)) {
        header("Location: http://127.0.0.1:5000/");
        exit();
    } else {
        $login_error = "Authentication failed. Please check your username and password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Include Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css" />
</head>
<body class="container mt-5">

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Login</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <a href="http://127.0.0.1:5000/">
                <button type="submit" class="btn btn-primary">Login</button>
</a>

                <p class="para-2">
                    Not have an account? <a href="signup.php">Sign Up Here</a>
                </p>
            </form>

            <?php
            // Display login error (if any)
            if (isset($login_error)) {
                echo "<p class='mt-3 text-danger'>$login_error</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
