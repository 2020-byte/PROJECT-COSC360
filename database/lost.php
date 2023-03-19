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
// Redirect to authorized page
header("Location: ./index.php");
exit();
}

$random_number = null;
// Check if login form was submitted
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if($action == 'sendCode') {
        // Check if email and password are set and not empty
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
        
        
            // Prepare and execute SQL query to check if email and password match
            $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
        
            // Check if a row was returned
            if ($result->num_rows == 1) {
                // Authentication successful, set session variables
                $row = $result->fetch_assoc();
                
            
                $to = $email;
                $subject = "Test Email";
                $message = "This is a test email sent using PHP.";
                // mail($to, $subject, $message);


                // $random_number = random_int(1000, 9999);
                $error = false;
                echo json_encode($error);

                exit();

            } else {
                // Authentication failed, display error message
                $error = true;
                echo json_encode($error);
                exit();
    
    
            
        }
        
            // Close database connection
            mysqli_close($conn);
        } else {
            // Email and/or password inputs are empty, display error message
            $error_message = "Please enter a valid email.";
            
        }

    }else  if ($action == 'login') {
        if (!empty($_POST['code'])) {
            $email = $_POST['email'];

            // Prepare and execute SQL query to check if email and password match
            $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
        
            // Check if a row was returned
            if ($result->num_rows == 1) {
                // Authentication successful, set session variables
                $row = $result->fetch_assoc();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $email;
        
                $error = false;
                echo json_encode($error);
                exit();
            } else {
                // Authentication failed, display error message
                $error = true;
                echo json_encode($error);
                exit();
            
            }

        } else {
            // Authentication failed, display error message
            $error_message = "Invalid Code.";
            echo json_encode($error_message);
            exit();
        
        }
    }
} 




?>