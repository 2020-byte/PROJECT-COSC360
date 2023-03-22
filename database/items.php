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

$search = "";
if(isset($_GET['search'])) {
    $search = $_GET['search'];
}

if(isset($_GET['getNum'])) {
    $sql = "SELECT COUNT(*) as count FROM items WHERE title LIKE ?";

    $stmt = $conn->prepare($sql);

    if($search) {
        $search = "%" . $search . "%";
        $stmt->bind_param("s", $search);
    }else {
        $search = "%" . "" . "%";
        $stmt->bind_param("s", $search);
    }


    // Execute the prepared statement
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result) {
        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);
        
        // Get the count of items from the row
        $count = $row['count'];
        
        // Print the count of items
        header("Content-type: application/json");
        echo json_encode($count);
    } else {
        // If the query failed, print the error message
        header("Content-type: application/json");
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    $stmt->close();

    // Close the connection
    mysqli_close($conn);
    exit();
}




if(!$search) {
    $sql = "SELECT * FROM items ORDER BY ";
} else {
    $sql = "SELECT * FROM items WHERE title LIKE ? ORDER BY ";
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
} else {
    $sql = $sql . "created_at DESC";
}



$sql = $sql." LIMIT 4";






$stmt = $conn->prepare($sql);
if(!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

if(isset($_GET['page'])) {
    $page = intval($_GET['page']);
    $offset = ($page - 1) * 4;
    $sql .= " OFFSET ?";
    
    $stmt = $conn->prepare($sql);
    if(!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    
    if($search && $search !="") {
        $search = "%" . $search . "%";
        $stmt->bind_param("si", $search, $offset);
    } else {
        $stmt->bind_param("i", $offset);
    }
    
} else {
    if($search && $search !="") {
        $search = "%" . $search . "%";
        $stmt->bind_param("s", $search);
    }
}



$stmt->execute();

$data = array();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // Loop through all rows and add data to the array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close connection
$stmt->close();
$conn->close();

// Return the data as JSON
header("Content-type: application/json");
//이거 전에 echo하면 ajax에서 그걸 받아가는 듯
echo json_encode($data);
?>