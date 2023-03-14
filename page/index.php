

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
<body>
<div id="offCanvas"></div>
<?php
// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
  echo '<script>user.signIn("username","'.$_SESSION['email'].'", true);</script>';
  echo '<script>console.log("'.$_SESSION['user_id'].'")</script>';
}

?>





<style>
    /* Add padding to body when Offcanvas is open */
body.offcanvas-open {
  padding-right: 15px; /* Change to the width of your scrollbar */
}
</style>

    <!-- Header Search Bar -->
    
    <link rel="stylesheet" href="../component/searchBar/searcBar.css">
    <header id="headerSearchBar" style="position: sticky; top: 0; z-index: 1;">
        <script src="../component/searchBar/searchBar.js" async></script>
    </header>

    
    <div class="mx-auto p-4 d-flex flex-column justify-content-center" style=" max-width:1200px; height: 80vh;">
        
        <link rel="stylesheet" href="../component/welcome/welcome.css">
        <div class="button_container">
            <p class="weldescription">COSC360 Project: A Carmel Clone Site :)</p>
            <button href="./productSearch.php" class="welbtn"><span>Let's Dive In!</span></button>
            <script>
                $('.welbtn').on('click', () => {
                    window.location.href = "./productSearch.php"
                })
            </script>
        </div>

          
    </div>    
    <link rel="stylesheet" href="../component/homeBackground/homeBackground.css">
    <div id="backgroundBox">
        <script src="../component/homeBackground/homeBackground.js"></script>
    </div>    
    
   

    
    <div id="footer">
        <script src="../component/footer/footer.js"></script>
    </div>

    

    
        
    

</body>
</html>






