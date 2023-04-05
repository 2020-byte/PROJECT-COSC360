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

if($userId != 1) {
    if($userId != $_POST['userId']) {
        exit();
    }
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
            
          
            $stmt = $conn->prepare("UPDATE opinions SET review = ?, rating = ?, updated_at =  NOW() WHERE id = ?");
            $stmt->bind_param("ssi", $review, $rating, $id);
            // Execute the statement
            if ($stmt->execute() === TRUE) {
                // Prepare the SQL statement to get the average rating
                $sql = "SELECT AVG(rating) AS average_rating FROM opinions WHERE itemId = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $itemId);

                // Execute the statement
                $stmt->execute();
                $result = $stmt->get_result();

                // Fetch the result as an associative array
                $row = $result->fetch_assoc();
                $average_rating = $row['average_rating'];

                // Close the statement and result set
                $stmt->close();
                $result->close();

                // Prepare the SQL statement to update the other table
                $sql = "UPDATE items SET rating = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("di", $average_rating, $itemId);


                if ($stmt->execute() === TRUE) {
                    header("Location: ../page/product.php?id=".$itemId);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $stmt->close();
                $conn->close();

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        } else if ($action == 'delete') {
          // process delete action
          $stmt = $conn->prepare("DELETE FROM opinions WHERE id = ?");
          $stmt->bind_param("i", $id);
          if ($stmt->execute() === TRUE) {
                // Prepare the SQL statement to get the average rating
                $sql = "SELECT AVG(rating) AS average_rating FROM opinions WHERE itemId = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $itemId);

                // Execute the statement
                $stmt->execute();
                $result = $stmt->get_result();

                // Fetch the result as an associative array
                $row = $result->fetch_assoc();
                $average_rating = $row['average_rating'];

                // Close the statement and result set
                $stmt->close();
                $result->close();

                // Prepare the SQL statement to update the other table
                $sql = "UPDATE items SET rating = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("di", $average_rating, $itemId);


                if ($stmt->execute() === TRUE) {
                    header("Location: ../page/product.php?id=".$itemId);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $stmt->close();
                $conn->close();

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        }
      }

}




?>