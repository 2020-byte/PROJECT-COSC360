<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSC360-carmelcarmel</title>

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/productSearch.css">

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

  if ($_SESSION['user_id'] == 1 ) {
    echo '<script>console.log("'.$_SESSION['user_id'].'")</script>';


    echo '<script>auth.signIn("username","'.$_SESSION['email'].'", true, true);</script>';

}
} 
?>


    <!-- Header Search Bar -->
    
    <link rel="stylesheet" href="../component/searchBar/searcBar.css">
    <header id="headerSearchBar" style="position: sticky; top: 0; z-index: 1;">
        <script src="../component/searchBar/searchBar.js" async></script>
    </header>
    <div class="mx-auto p-4" style=" max-width:1200px; min-height: 685px;">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="Product Search">Product Search</li>
            </ol>
        </nav>

        <h2>Product Search</h2>

        <hr>
        
        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1) {
            echo '<form id="addItem" action="../database/addItem.php" method="POST">';

            
            echo '<div class="input-group mb-3">';
            echo '<div class="input-group-prepend">';
            echo    '<span class="input-group-text" id="titleSpan">Title</span>';
            echo '</div>';
            echo '<input type="text" name="title" class="form-control" id="title" aria-describedby="titleSpan" required>';
            echo '</div>';
            
            echo '<div class="input-group mb-3">';
            echo '<div class="input-group-prepend">';
            echo    '<span class="input-group-text">$</span>';
            echo '</div>';
            echo '<input type="text" name="price" class="form-control" aria-label="Amount (to the nearest dollar)" rquired>';
            echo '<div class="input-group-append">';
            echo    '<span class="input-group-text">.00</span>';
            echo '</div>';
            echo '</div>';
            
            echo '<div class="input-group mb-3">';
            echo '<div class="input-group-prepend">';
            echo    '<span class="input-group-text" id="purchaselinkSpan">Purchase Link URL</span>';
            echo '</div>';
            echo '<input type="text" name="link" class="form-control" id="purchaseLink" aria-describedby="purchaselinkSpan" required>';
            echo '</div>';
            
            echo '<div class="input-group mb-3">';
            echo '<div class="input-group-prepend">';
            echo    '<span class="input-group-text" id="imageLinkSpan">Image Link URL</span>';
            echo '</div>';
            echo '<input type="text" name="image" class="form-control" id="imageLink" aria-describedby="imageLinkSpan" required>';
            echo '</div>';

            echo '<div class="input-group mb-3">';
            echo    '<div class="input-group-prepend">';
            echo        '<span class="input-group-text h-100">Description</span>';
            echo    '</div>';
            echo    '<textarea rows="5" name="description" class="form-control" aria-label="description" required></textarea>';
            echo '</div>';

            echo '<div class="input-group mb-3">';
            echo    '<div class="input-group-prepend">';
            echo        '<span class="input-group-text h-100">Details</span>';
            echo    '</div>';
            echo    '<textarea rows="3" name="detail" class="form-control" aria-label="details" required></textarea>';
            echo '</div>';
            echo '<button type="submit" name="action" value="add" class="btn btn-outline-primary w-100 mb-3">Add Item</button>';





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
        

        <form  class="d-flex justify-content-between">
            <div>
                <input id="hiddenSearch" name="search" type="hidden">
                <script>

                    $(document).ready(() => {

                        $("#hiddenSearch").val(search);
                    })
                 
                </script>
                <div class="d-flex justify-content-center">
                    <label for="" class="form__label">Order by</label>
                    <select name="order" id="order" class="form__select">
                        <option value="0">Latest date</option>
                        <option value="1">Price: low to high</option>
                        <option value="2">Price: high to low</option>
                        <option value="3">Name</option>
                        <option value="4">Average Customer Review</option>
                    </select>
                </div>
            </div>
            <button id="orderButton" name="order" class="form__button">Update</button>
            
        </form>

        <hr>

        <nav aria-label="Page navigation">
            <ul class="nav__pagination">
                <li>
                    <a class="nav__page_previous" href="#" aria-label="Previous">
                        <span>&laquo; Prev</span>
                    </a>
                </li>
                <li class="nav__page_item">
                    <a href="#" class="nav__page_link">1</a>
                </li>
                <li class="nav__page_item">
                    <a href="#" class="nav__page_link">2</a>
                </li>
                <li class="nav__page_item">
                    <a href="#" class="nav__page_link">3</a>
                </li>
                <li>
                    <a class="nav__page_next" href="#" aria-label="Next">
                        <span>Next &raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

        <hr>


        <link rel="stylesheet" href="../component/productItem/productItem.css">
        <section class="item_list d-flex flex-column gap-5">
            <script  src="../component/productItem/productitems.js" async></script>
        </section>

        <hr>

        <nav aria-label="Page navigation">
            <ul class="nav__pagination">
                <li>
                    <a class="nav__page_previous" href="#" aria-label="Previous">
                        <span>&laquo; Prev</span>
                    </a>
                </li>
                <li class="nav__page_item">
                    <a href="#" class="nav__page_link">1</a>
                </li>
                <li class="nav__page_item">
                    <a href="#" class="nav__page_link">2</a>
                </li>
                <li class="nav__page_item">
                    <a href="#" class="nav__page_link">3</a>
                </li>
                <li>
                    <a class="nav__page_next" href="#" aria-label="Next">
                        <span>Next &raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
    <div id="footer">
        <script src="../component/footer/footer.js"></script>
    </div>




    
</body>
</html>


