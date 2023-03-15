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
    const showEmail = (email) => {
        $(document).ready(() => {
            $("#form2Email").val(email);
            $("#sendCodeButton").html("Resend");
        })
    }
</script>
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
if (isset($_POST['sendCode'])) {
    // Check if email and password are set and not empty
    if (!empty($_POST['email'])) {
      // Check if email and password are valid
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
        
  
        $random_number = random_int(1000, 9999);
        echo '<script>console.log("'.$random_number.'")</script>';
        echo '<script>showEmail("'.$email.'");</script>';
      } else {
        // Authentication failed, display error message
        $error_message = "Invalid email.";
        echo '<script>console.log("'.$error_message.'");</script>';
        echo '<script>showMessage("' . $error_message . '")</script>';


        
    }
  
      // Close database connection
      mysqli_close($conn);
    } else {
      // Email and/or password inputs are empty, display error message
      $error_message = "Please enter a valid email.";
      echo '<script>console.log("'.$error_message.'");</script>';
      
    }
  }
  else if(isset($_POST['login'])) {
    echo '<script>console.log("'.$random_number.'")</script>';
    if (!empty($_POST['code']) && $_POST['code'] == $random_number) {
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
  
        // Redirect to authorized page
        header("Location: ./index.php");
        exit();
    }
  }  else {
        // Authentication failed, display error message
        $error_message = "Invalid Code.";
        echo '<script>console.log("'.$error_message.'");</script>';
        echo '<script>showMessage("' . $error_message . '")</script>';


        
    }
  }




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
                <li class="breadcrumb-item active" aria-current="Sign In">Sign In</li>
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
                    <div >
                        <h2>Login</h2>
                        <form action="" method="POST">
                            <div class="inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input id="form2Email" type="email" name="email" required>
                                <label for="form2Email">Email</label>
                            </div>
                            <button type="submit" name="sendCode" id="sendCodeButton" >Send Code</button>
                        </form>
                        <form action="" method="POST">
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input id="form2Code" type="password" name="code" required pattern="\d{4}"> 
                                <label for="form2Code">4 digit Code</label>
                            </div>
                            <button typ="submit" name="login" id="signButton" >Log In</button>
                        </form>
                        <div class="register">
                            <p>Don't have a account? <a href="./signup.php">Register</a></p>
                        </div>
                        <div class="register">
                            <p>Already have a account? <a href="./login.php">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        </div>
    </div>

    

    <div id="footer">
        <script src="../component/footer/footer.js"></script>
    </div>



    <!-- <script>
        $('#signButton').click(() => {
            let isValid = false;
            isValid =  $('#form2Email').get(0).checkValidity() && $('#form2Password').get(0).checkValidity();
            console.log(isValid);
        })
    
        
    </script> -->

</body>
</html>