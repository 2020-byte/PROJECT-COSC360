<?php
// Load the environment variables from the .env file
$env = parse_ini_file('../../../.env');

// Set the environment variables as PHP constants
foreach ($env as $key => $value) {
    putenv("$key=$value");
    $_ENV[$key] = $value;
}

// Get the values of the environment variables
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_DATABASE'];

$conn = mysqli_connect('cosc360.ok.ubc.ca', '88262753', '88262753', 'db_88262753');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
}



try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the user data from the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();

        // Get the form data
        $username = isset($_POST["username"]) && $_POST["username"] != "" ? $_POST["username"] : $userData["username"];
        $password = isset($_POST["password"]) && $_POST["password"] != "" ? $_POST["password"] : $userData["password"];
        $email = isset($_POST["email"]) && $_POST["email"] != "" ? $_POST["email"] : $userData["email"];
        
        // Check if a file was uploaded
        if (isset($_FILES['userImage']) && $_FILES['userImage']['error'] == UPLOAD_ERR_OK) {
            // Get the file content
            $file_content = file_get_contents($_FILES['userImage']['tmp_name']);
            //echo $file_content;
            //echo "<br/>";
            $image_type = $_FILES['userImage']['type'];
            //echo $image_type;
        } else {
            $file_content = $userData["image"];
            $image_type = $userData["contentType"];
        }

        // Update the user data
        $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, email = ?, image = ?, contentType = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $username, $password, $email, $file_content, $image_type, $userId);
        $stmt->execute();

        if ($stmt->errno != 0) {
            echo "Error updating row: " . $stmt->error;
        } 

        // Redirect to profile page
        header("Location: ../page/profile.php");
    }
} catch (Exception $e) {
    // Handle the exception gracefully
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="../page/profile.php";</script>';
    // Redirect to profile page if the user clicks "OK" on the alert box
    exit;
}

?>