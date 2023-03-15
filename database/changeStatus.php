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





if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST['userId'] || empty($_POST['status']))) exit();
    $id = $_POST['userId'];
    echo $_POST['status'];
    $status = $_POST['status'] == 1? 0: 1;
    echo $id;
    echo $status;
    
    // Update the user data
    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $id);
    $stmt->execute();


    

    if ($stmt->errno != 0) {
        echo "Error updating row: " . $stmt->error;
    } else {
        exit();
    }
}




?>