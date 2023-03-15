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


// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM opinions WHERE itemId = ? ORDER BY created_at DESC;");
// $stmt = $conn->prepare("SELECT * FROM opinions");


if(isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];
}


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM opinions WHERE id = ?");
    $stmt->bind_param("i", $id);

}else {
    $stmt->bind_param("i", $itemId);

}

$stmt->execute();

// Get the result
$result = $stmt->get_result();

$data = array();
if ($result->num_rows > 0) {
    // Loop through all rows and add data to the array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);


// Close connection
$stmt->close();
$conn->close();



?>