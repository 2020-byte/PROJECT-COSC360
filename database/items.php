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
$search = $_GET['search'];

if(!$search) {
    $sql = "SELECT * FROM items ORDER BY ";
}else {
    $sql = "SELECT * FROM items WHERE title LIKE '%" . $search . "%' ORDER BY ";
}



if(isset($_GET['order'])) {


    switch ($_GET['order']) {
        case "1":
            $sql = $sql . "price ASC";
            break;
        case "2":
            $sql = $sql . "price DESC";
            break;
        case "3":
            $sql = $sql . "title ASC";
            break;
        case "4":
            $sql = $sql . "rating DESC";
            break;
        default:
            $sql = $sql . "created_at DESC";
            break;
    }
    
}else {
    $sql = $sql . "created_at DESC";
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