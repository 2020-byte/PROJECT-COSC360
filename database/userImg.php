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
    // Get the user data from the database
    $stmt = $conn->prepare("SELECT image, contentType FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    // Get the image data and content type
    $imageData = $userData["image"];
    $contentType = $userData["contentType"];

    // Output the image data
    // header("Content-Type: $contentType");
    // echo $imageData;


    $base64 = base64_encode($imageData);
    $src = 'data:'.$contentType.';base64,'.$base64;

    // Return the JSON object with the src value
    $response = array('src' => $src);
    header('Content-Type: application/json');
    echo json_encode($response);
} catch (Exception $e) {
    // Handle the exception gracefully
    echo "Error: " . $e->getMessage();
}
?>