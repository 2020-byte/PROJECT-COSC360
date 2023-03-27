<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSC360-carmelcarmel</title>

    <link rel="stylesheet" href="../css/reset.css">

    <script src="https://kit.fontawesome.com/28b63fb9f5.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../Auth/auth.js"></script>
</head>

<script>
    const showMessage = (error_message) => {
        alert(error_message);

    }
</script>

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
    // Redirect to authorized page
    header("Location: ./index.php");
    exit();
  }

  $error_message = "";

    // Check if login form was submitted
if (isset($_POST['signup'])) {
    // Check if email and password are set and not empty
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username'])) {
      // Check if email and password are valid
      $email = $_POST['email'];
      $password = $_POST['password'];
      $password = password_hash( $password, PASSWORD_DEFAULT);
      $username = $_POST['username'];

      $email_query = "SELECT * FROM users WHERE email='$email'";
        $email_result = mysqli_query($conn, $email_query);

        if (mysqli_num_rows($email_result) > 0) {
            // Email already exists
            $error_message = "Email already exists.";

        }else {
            // Check if username already exists
            $username_query = "SELECT * FROM users WHERE username='$username'";
            $username_result = mysqli_query($conn, $username_query);

            if (mysqli_num_rows($username_result) > 0) {
                // Username already exists
                $error_message =  "Username already exists.";
            } else {
                // Email and username are unique, insert new user data into database
                $insert_query = "INSERT INTO users (email, password, username) VALUES ('$email', '$password', '$username')";
                mysqli_query($conn, $insert_query);

                // Prepare and execute SQL query to check if email and password match
                $stmt = $conn->prepare('SELECT id FROM users WHERE email = ? AND password = ?');
                $stmt->bind_param('ss', $email, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $email;
        $_SESSION['status'] = 1;
  
        // Redirect to authorized page
        header("Location: ./index.php");
        exit();
            }
        }
    } else {
        // Email, password, or username was empty
        $error_message =  "Please fill in all fields.";
    }
  
  }
  if($error_message != "") echo '<script>showMessage("' . $error_message . '")</script>';


?>


<body style="height:100vh;">

    <!-- Header Search Bar -->
    
    <link rel="stylesheet" href="../component/searchBar/searcBar.css">
    <header id="headerSearchBar" style="position: sticky; top: 0; z-index: 1;">
        <script src="../component/searchBar/searchBar.js" async></script>
    </header>

        <div class="mx-auto p-4" style=" max-width:1200px;">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="Sign In">Sign Up</li>
            </ol>
        </nav>

        <hr>
        
        <style>
            @media only screen and (max-width: 992px) {
                .menu {
                    display: none!important;
                }
            }

        </style>

        <link rel="stylesheet" href="../component/signInForm/signInForm.css">
        <section id="signInForm">
            <div class="form-box">
                <div class="form-value">
                    <form method="POST">
                        <h2>Sign Up</h2>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input id="form2Email" type="email" name="email" required>
                            <label for="form2Email">Email</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input id="form2Password" type="password" name="password" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,29}$"  title="Minimum 8 and Maximum 30 Characters, Containing Uppercase, Lowercase, and Numeric Characters"> 
                            <label for="form2Password">Password</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input id="form2Username" name="username" type="text" required pattern="^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{3,29}$" title="Minimum 3 and Maximum 30 Characters, and Alphanumeric/Period Characters Allowed, No Leading/Trailing Dots, No Consecutive Dots.">
                            <label id="usernameLabel" for="form2Username">Username</label>
                        </div>
                        <button id="signButton" type="submit" name="signup">Sign Up</button>
                        <div class="register">
                            <p>Already have a account? <a href="./login.php">Sign In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        
    </div>

    

    <div id="footer">
        <script src="../component/footer/footer.js"></script>
    </div>



<div id="offCanvas"></div>


<!-- <script>
    $('#signButton').click(() => {
        let isValid = false;
        isValid = $('#form2Username').get(0).checkValidity() && $('#form2Email').get(0).checkValidity() && $('#form2Password').get(0).checkValidity();
        console.log(isValid);

        
        if(!isValid) return;
        event.preventDefault();
        user.signIn($('#form2Username').val(), $('#form2Email').val(), true);
        console.log(user.user);
        window.location.href = "./productSearch.html";
        

    })

    
</script> -->

</body>
</html>