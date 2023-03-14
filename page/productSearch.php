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

        <form action="" class="d-flex justify-content-between">
            <div>
                <div class="d-flex justify-content-center">
                    <label for="" class="form__label">Order by</label>
                    <select name="" id="" class="form__select">
                        <option value="0"></option>
                        <option value="1">Price: low to high</option>
                        <option value="2">Price: high to low</option>
                        <option value="3">Name</option>
                        <option value="4">Average Customer Review</option>
                    </select>
                </div>
            </div>
            <button class="form__button">Update</button>
            
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
            <script  src="../component/productItem/productitem.js" async></script>
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


