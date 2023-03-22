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



// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $action = $_POST['action'];

    $itemId = $_POST['itemId'];

    if($action == 'delete') {
        $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        header("Location: ../page/productSearch.php");

        if ($stmt->errno != 0) {
            echo "Error deleting row: " . $stmt->error;

        }

    }else {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $link = $_POST['link'];
        $image = $_POST['image'];
        $description = $_POST['description'];
        $detail = $_POST['detail'];

        if($action == 'add') {

            // Construct the SQL statement
            $sql = "INSERT INTO items (title, price, link, image, description, detail) VALUES (?, ?, ?, ?, ?, ?)";

            // Prepare the statement
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }

            // Bind the parameters
            $stmt->bind_param("sdssss", $title, $price, $link, $image, $description, $detail);

            // Execute the statement
            if ($stmt->execute() === TRUE) {
                header("Location: ../page/productSearch.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        }
        else if ($action == 'edit') {

            // Construct the SQL statement
            $sql = "UPDATE items SET title = ?, price = ?, link = ?, image = ?, description = ?, detail = ? WHERE id = ?";
            
            // Prepare the statement
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }

            // Bind the parameters
            $stmt->bind_param("sdssssi", $title, $price, $link, $image, $description, $detail, $itemId);

            // Execute the statement
            if ($stmt->execute() === TRUE) {
                header("Location: ../page/product.php?id=".$itemId."");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        }
    }
    

    
}
$conn->close();


?>