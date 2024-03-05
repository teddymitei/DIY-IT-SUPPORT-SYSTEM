<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bsod_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function isUsernameTaken($username, $conn) {
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;
    $stmt->close();
    return $rows > 0;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST["new_username"];
    $new_email = $_POST["new_email"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        $signup_error = "Passwords do not match. Please re-enter your password.";
    } else {
        if (isUsernameTaken($new_username, $conn)) {
            $signup_error = "Username already taken. Choose a different username.";
        } else {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $new_username, $new_email, $hashed_password);
            $stmt->execute();
            $stmt->close();

            // Redirect to main page after signup
            $_SESSION["username"] = $new_username;
            header("Location: main.php");
            exit;
        }
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css" />
</head>
<body class="container mt-5">

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Signup</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="new_username">Username:</label>
                <input type="text" id="new_username" name="new_username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_email">Email:</label>
                <input type="text" id="new_email" name="new_email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password">Password:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>


            <button type="submit" class="btn btn-primary">Signup</button>
            <p class="para-2">
      Already have an account? <a href="http://localhost/itsupport/templates/login.php">Login here</a>
    </p>
        </form>

        <?php
        if (isset($signup_error)) {
            echo "<p class='mt-3 text-danger'>$signup_error</p>";
        }
        ?>
    </div>
</div>

</body>
</html>