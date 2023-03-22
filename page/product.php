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
<body style="height:100vh;">
<div id="offCanvas"></div>
<?php
// Start session
session_start();

// Check if user is already logged in
if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
  // Redirect to authorized page
  header("Location: ./index.php");
  exit();
}



// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
  echo '<script>user.signIn("username","'.$_SESSION['email'].'", '.$_SESSION['user_id'].');</script>';
  echo '<script>console.log("'.$_SESSION['user_id'].'")</script>';
  echo '<script>const user_id = '.$_SESSION['user_id'].'</script>';

  if ($_SESSION['user_id'] == 1 ) {
    echo '<script>console.log("'.$_SESSION['user_id'].'")</script>';

    echo '<script>auth.signIn("username","'.$_SESSION['email'].'", true, true);</script>';

}
} 

?>

<script>
  let userStatus;
  <?php
    echo 'userStatus='.$_SESSION['status'].';';
  ?>
</script>




    <!-- Header Search Bar -->
    
    <link rel="stylesheet" href="../component/searchBar/searcBar.css">
    <header id="headerSearchBar" style="position: sticky; top: 0; z-index: 1;">
        <script src="../component/searchBar/searchBar.js" async></script>
    </header>

    <div class="mx-auto p-4" style=" max-width:1200px; background-color: rgb(243, 240, 240);">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="productSearch.php">Product Search</a></li>
                <li class="breadcrumb-item active" aria-current="Product">Product</li>
            </ol>
        </nav>

        <hr>

        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1 && isset($_GET['id'])) {
          
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

          $itemId = $_GET['id'];
          // Prepare and execute the SQL query
          $stmt = $conn->prepare("SELECT title, price, link, image, description, detail FROM items WHERE id = ?");

          $stmt->bind_param("i", $itemId);
          $stmt->execute();

          // Get the result
          $result = $stmt->get_result();

          $row = $result->fetch_assoc();
          
          $title = $row['title'];
          $price = $row['price'];
          $link = $row['link'];
          $image = $row['image'];
          $description = $row['description'];
          $detail = $row['detail'];

          $stmt->close();
          $conn->close();
          
          
          
          echo '<form id="addItem" action="../database/addItem.php" method="POST">';

            
            echo '<div class="input-group mb-3">';
            echo '<div class="input-group-prepend">';
            echo    '<span class="input-group-text" id="titleSpan">Title</span>';
            echo '</div>';
            echo '<input type="text" name="title" class="form-control" id="title" aria-describedby="titleSpan" required value="'.$title.'">';
            echo '</div>';
            
            echo '<div class="input-group mb-3">';
            echo '<div class="input-group-prepend">';
            echo    '<span class="input-group-text">$</span>';
            echo '</div>';
            echo '<input type="text" name="price" class="form-control" aria-label="Amount (to the nearest dollar)" rquired value="'.$price.'">';
            echo '<div class="input-group-append">';
            echo    '<span class="input-group-text">.00</span>';
            echo '</div>';
            echo '</div>';
            
            echo '<div class="input-group mb-3">';
            echo '<div class="input-group-prepend">';
            echo    '<span class="input-group-text" id="purchaselinkSpan">Purchase Link URL</span>';
            echo '</div>';
            echo '<input type="text" name="link" class="form-control" id="purchaseLink" aria-describedby="purchaselinkSpan" required value="'.$link.'">';
            echo '</div>';
            
            echo '<div class="input-group mb-3">';
            echo '<div class="input-group-prepend">';
            echo    '<span class="input-group-text" id="imageLinkSpan">Image Link URL</span>';
            echo '</div>';
            echo '<input type="text" name="image" class="form-control" id="imageLink" aria-describedby="imageLinkSpan" required value="'.$image.'">';
            echo '</div>';

            echo '<div class="input-group mb-3">';
            echo    '<div class="input-group-prepend">';
            echo        '<span class="input-group-text h-100">Description</span>';
            echo    '</div>';
            echo    '<textarea rows="5" name="description" class="form-control" aria-label="description" required>'.$description.'</textarea>';
            echo '</div>';

            echo '<div class="input-group mb-3">';
            echo    '<div class="input-group-prepend">';
            echo        '<span class="input-group-text h-100">Details</span>';
            echo    '</div>';
            echo    '<textarea rows="3" name="detail" class="form-control" aria-label="details" required >'.$detail.'</textarea>';
            echo '</div>';

            echo '<div class="d-flex gap-2 flex-md-row flex-column">';
            echo '<button type="submit" name="action" value="edit" class="btn btn-outline-primary w-100 mb-3">Edit Info</button>';
            echo '<button type="submit" name="action" value="delete" class="btn btn-outline-primary w-100 mb-3">Delete Item</button>';
            echo '</div>';

            echo '<input type="hidden" name="itemId" value="'.$itemId.'">';





            echo '</form>';
            echo '<button id="unfold" type="button" class="btn btn-outline-success w-100">Unfold</button>';
            echo '<hr>';




        }

        ?>

        <style>
            #addItem {
                display: none;
            }
        </style>

        <script>
            $("#unfold").click(function(event) {
                
                if ($(this).text() === 'Unfold') {
                    $("#addItem").slideDown(1000);
                    $(this).text('Fold');
                    $(this).removeClass("btn-outline-success");
                    $(this).addClass("btn-outline-danger");

                } else {
                    $("#addItem").slideUp(1000);
                    $(this).text('Unfold');
                    $(this).removeClass("btn-outline-danger");
                    $(this).addClass("btn-outline-success");

                }
            });
        </script>


        <link rel="stylesheet" href="../component/productInfo/productInfo.css">
        <div class="product_info">
            <script src="../component/productInfo/productInfo.js"></script>
        </div>
        
<hr>
        <link rel="stylesheet" href="../component/opinions/opinions.css">
        <div id="opinionList">

            <script src="../component/opinions/opinions.js"></script>
            
        </div>

        <hr>
      




        <form method="POST" action="../database/review.php" class="my-4 d-flex flex-column gap-3">
        <input type="hidden" name="itemId">
        <script>
          $(document).ready(function() {
              $('input[name="itemId"]').val(itemId);
              console.log(itemId);


          });
        </script>
        

            <div class="form-group d-flex align-items-center gap-3">
                <label for="rating" class="ms-3">Rating</label>
                <select name="rating" class="form-control" id="rating">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            <div class="form-group">
              <label for="review" style="display: none;">Review</label>
              <textarea name="review" class="form-control" id="review" rows="6" placeholder="Review" required></textarea>
            </div>
            <?php

              if($_SESSION['status'] == 0) {
                echo '<button disabled class="btn btn-outline-danger w-100">Not allowed</button>';
              }else {
                echo '<button type="submit" class="btn btn-outline-primary w-100">Submit</button>';
              }
            ?>
        </form>
    </div>

    <div id="footer">
      <script src="../component/footer/footer.js"></script>
  </div>





    

</body>
</html>