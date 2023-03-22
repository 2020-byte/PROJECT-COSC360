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

$itemId = $_POST["itemId"];
try {
    // Check if the form was submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Get the form data
        $rating = $_POST["rating"];
        $review = $_POST["review"];
        
        // Start session
        session_start();

        // Check if user is already logged in
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
        }

        
        // Check if the title and description are not empty
        if(!empty($rating) && !empty($review)){
            
            // Prepare the SQL statement
            $sql = "INSERT INTO opinions (rating, review, userId, itemId) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("ssii", $rating, $review, $userId, $itemId);

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
            
            // Close the statement and connection
            $stmt->close();
            $conn->close();
        }
    }

} catch (Exception $e) {
    // Handle the exception gracefully
    echo "Error: " . $e->getMessage();
    header("Location: ../page/product.php?id=".$itemId."");

}

header("Location: ../page/product.php?id=".$itemId."");


    
?>