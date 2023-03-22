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

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email= $_GET['email'];
$username = $_GET['username'];


$sql = "SELECT * FROM users ";


if($email) {
    $sql = $sql."WHERE email LIKE '%".$email."%' ";
    if($username) {
        $sql = $sql."AND username LIKE '%".$username."%'";
    }
}else {
    if($username) {
        $sql = $sql."WHERE username LIKE '%".$username."%'";
    }
}



$result = $conn->query($sql);




$data = array();
if ($result->num_rows > 0) {
    // Loop through all rows and add data to the array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close connection
$conn->close();

// Return the data as JSON
echo json_encode($data);

?>