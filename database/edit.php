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


// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
}

if($userId != $_POST['userId']) {
    exit();
}


// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST["opinionId"];
    $itemId = $_POST["itemId"];
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action == 'edit') {
          // process edit action
            $rating = $_POST["rating"];
            $review = $_POST["review"];
            
          
            $stmt = $conn->prepare("UPDATE opinions SET review = ?, rating = ? WHERE id = ?");
            $stmt->bind_param("ssi", $review, $rating, $id);
            $stmt->execute();
            header("Location: ../page/opinion.php?id=".$id);

            if ($stmt->errno != 0) {
                echo "Error deleting row: " . $stmt->error;
            }

        } else if ($action == 'delete') {
          // process delete action
          $stmt = $conn->prepare("DELETE FROM opinions WHERE id = ?");
          $stmt->bind_param("i", $id);
          $stmt->execute();
          header("Location: ../page/product.php?id=".$itemId);


          if ($stmt->errno != 0) {
            echo "Error deleting row: " . $stmt->error;

        }

        }
      }

}




?>