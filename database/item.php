<?php
// Load the environment variables from the .env file
$env = parse_ini_file('../.env');

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

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$itemId = $_GET['id'];


// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
// $stmt = $conn->prepare("SELECT * FROM opinions");

$itemId = $_GET['id'];
$stmt->bind_param("i", $itemId);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$row = $result->fetch_assoc();

// Return the data as JSON
echo json_encode($row);

$stmt->close();
$conn->close();

?>