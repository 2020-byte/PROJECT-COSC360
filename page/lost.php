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
<?php

// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to authorized page
    header("Location: ./index.php");
    exit();
}
?>

<script>
    const showMessage = (message) => {
        alert(message);

    }


    let randomNumber = "";
    let isCodeSent = false;
    const checkEmail = (email, sendCode) => {
        $.ajax({
            url: "../database/lost.php",
            type: "POST",
            dataType: "json",
            data: {
                email: email,
                action: sendCode

            },
            success: function(response) {
                if(response) {
                    showMessage("Invalid Email");
                    $("#form2Email").val("");
                }else {
                    const digit1 = Math.floor(Math.random() * 10);
                    const digit2 = Math.floor(Math.random() * 10);
                    const digit3 = Math.floor(Math.random() * 10);
                    const digit4 = Math.floor(Math.random() * 10);
                    randomNumber = ""+digit1 + digit2 + digit3 + digit4;
                    isCodeSent = true;
                    console.log(randomNumber);
                    $("#sendCodeButton").html("Resend");
                    showMessage("Code is sent.");
                }
                
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.log("Error: " + error);
                
            }
        });
    }

    const checkCode = (code, login, email) => {
        $.ajax({
            url: "../database/lost.php",
            type: "POST",
            dataType: "json",
            data: {
                code: code,
                action: login,
                email: email

            },
            success: function(response) {
                console.log(response);
                if(response) {
                    showMessage("Invalid Code.");
                    $("#form2Code").val("");
                }else {
                    window.location.href = "./index.php";
                }
                

            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.log("Error: " + error);
                
            }
        });
    }
</script>


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
                        <form>
                            <div class="inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input id="form2Email" type="email" name="email" required>
                                <label for="form2Email">Email</label>
                            </div>
                            <button type="button" name="action" value="sendCode" id="sendCodeButton" >Send Code</button>
                        </form>
                        <form>
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input id="form2Code" type="password" name="code" required pattern="\d{4}"> 
                                <label for="form2Code">4 digit Code</label>
                            </div>
                            <button type="button" name="action" value="login" id="signButton" >Log In</button>
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

    <script>
        const handleCodeButton = (e) => {
            e.preventDefault();
            const email = $("#form2Email").val();
            const value = $("#sendCodeButton").val();
            checkEmail(email, value);
        }

        $("#sendCodeButton").click((e) => {
            handleCodeButton(e);
        })

        $("#form2Email").keydown(function(e) {
            // If the pressed key is Enter, prevent the default behavior of the event
            if (e.keyCode === 13) {
                handleCodeButton(e);
            }
        });

        const handleSignButton = (e) => {
            e.preventDefault();
            console.log("hi");
            if(isCodeSent) {
                const code = $("#form2Code").val();
                const value = e.target.value;
                const email = $("#form2Email").val();
                if(code == randomNumber) {
                    checkCode(code, value, email);
                }else {
                    showMessage("Invalid Code.");
                    $("#form2Code").val("");
                }
            } else {
                showMessage("Code isn't sent.");
                $("#form2Code").val("");
            }
        }

        $("#signButton").click((e) => {
            handleSignButton(e);
        })

        $("#form2Code").keydown(function(e) {
            // If the pressed key is Enter, prevent the default behavior of the event
            if (e.keyCode === 13) {
                handleSignButton(e);
            }
        });

        
    </script>

    

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