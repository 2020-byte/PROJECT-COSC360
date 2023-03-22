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
        <script src="../component/searchBar/searchBar.js"></script>
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
            <ul class="nav__pagination" >
                
            </ul>
        </nav>
        <hr>


        <link rel="stylesheet" href="../component/productItem/productItems.css">
        <section class="item_list d-flex flex-column gap-5">
            <script>


const showPagination = (pageNum) => {
    let pagination_html = "";
            if(pageNum == 1) {
                pagination_html = pagination_html.concat(`
                <li class="nav__page_item">
                    <a href="#" class="nav__page_link currentPage" id="${currentPage}">1</a>
                </li>
                `);
            }else {
                pagination_html = pagination_html.concat(`
                <li>
                    <a class="nav__page_previous" href="#" aria-label="Previous">
                        <span>&laquo; Prev</span>
                    </a>
                </li>
                `)
                if(pageNum ==2) {
                    for(let i = 0; i < pageNum; i++) {
                        if(currentPage == i+1) {
                            pagination_html = pagination_html.concat(`
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link currentPage" id="${currentPage}">${i+1}</a>
                            </li>
                            `);
                        }else {
                            pagination_html = pagination_html.concat(`
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link">${i+1}</a>
                            </li>
                            `);
                        }
                    }

                }else if(pageNum >= 3) {
                    if(currentPage == 1 || currentPage == pageNum) {
                        pagination_html = pagination_html.concat(`
                        <li class="nav__page_item">
                            <a href="#" class="nav__page_link ${currentPage == 1? "currentPage":""}" ${currentPage == 1? `id="${currentPage}"`:""}>1</a>
                        </li>
                        <li class="nav__page_item">
                            <a href="#" class="nav__page_link">...</a>
                        </li>
                        <li class="nav__page_item">
                            <a href="#" class="nav__page_link ${currentPage == pageNum? "currentPage":""}" ${currentPage == pageNum? `id="${currentPage}"`:""}>${pageNum}</a>
                        </li>
                        `);
                    }else {

                        if(pageNum == 3) {
                            pagination_html = pagination_html.concat(`
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link">1</a>
                            </li>
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link currentPage" id="${currentPage}"}>${currentPage}</a>
                            </li>
                            <li class="nav__page_item">
                                <a href="#" class="nav__page_link">${pageNum}</a>
                            </li>
                            `);
                        }else if (pageNum >= 4) {
                            if(currentPage == 2) {
                                pagination_html = pagination_html.concat(`
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">1</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link currentPage" id="${currentPage}">${currentPage}</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">...</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">${pageNum}</a>
                                </li>
                                `);
                            }else if (currentPage == pageNum - 1) {
                                pagination_html = pagination_html.concat(`
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">1</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">...</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link currentPage" id="${currentPage}">${currentPage}</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">${pageNum}</a>
                                </li>
                                `);
                            }else {
                                pagination_html = pagination_html.concat(`
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">1</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">...</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link currentPage" id="${currentPage}">${currentPage}</a>
                                </li>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">...</a>
                                </li>
                                <li class="nav__page_item">
                                    <a href="#" class="nav__page_link">${pageNum}</a>
                                </li>
                                `);
                            }
                        }
                    }
                    

                }
                pagination_html = pagination_html.concat(`
                    <li>
                        <a class="nav__page_next " href="#" aria-label="Next">
                            <span>Next &raquo;</span>
                        </a>
                    </li>
                `)
            }
            pagination_html = pagination_html.concat(`
                <style>
                    .currentPage{
                        color: red;
                        font-weight: 900;
                    }
                </style>
            `)


            $(".nav__pagination").html(pagination_html);
            $(".nav__page_link").click((e) => {
                const text = $(e.target).text();
                console.log(text);
                if(text != "...") {
                    currentPage = text;
                    asyncItems(search, $('#order').val(), currentPage);
                }
            })
            $(".nav__page_next").click(() => {
                console.log("next");
                if(currentPage < pageNum) {
                    currentPage++;
                    asyncItems(search, $('#order').val(), currentPage);
                }
            });
            $(".nav__page_previous").click(() => {
                if(currentPage > 1) {
                    currentPage--;
                    asyncItems(search, $('#order').val(), currentPage);
                }
            });
}


const onClickPage = () => {

}



let star_html = `<i class="item_box__info__ul__item__rating fa-solid fa-star"></i>`




let totalPage;
const offset = 4;
let currentPage = 1;
let pageNum;


let order = 0;

$("#orderButton").click((e) => {
    e.preventDefault();

    currentPage = 1;
    asyncItems(search, $('#order').val());


})
////////////////////////////////////////////////////////////////////////
const getItemNum = (search="") => {
    $.ajax({
        url: "../database/items.php",
        type: "GET",
        dataType: "json",
        data: {
            search: search,
            getNum: 1,
        },
        success: function(response) {
            totalPage = response;
            pageNum = Math.ceil(totalPage/offset);
            console.log(pageNum);
            console.log("getItemNum: "+search);
            showPagination(pageNum);
            


        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.log("Error: " + error);
        }
    });
}
////////////////////////////////////////////////////////////////////////////
const asyncItems = (search = "", order, page=1) => {

    $.ajax({
        url: "../database/items.php",
        type: "GET",
        dataType: "json",
        data: {
            search: search,
            order: order,
            page: page

        },
        success: function(response) {
            // Update the HTML with the fetched data
            
            productItem_html = "";
            $(".item_list").html("");
            showData(response);
            showPagination(pageNum);
            console.log("asyncItems: "+search);
    
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.log("Error: " + error);
        }
    });
}


if(typeof search === "undefined") {
    search = false;
}

console.log(search);

if(!search) {
    getItemNum("");
    asyncItems("", order);
} else {
    getItemNum(search);
    asyncItems(search, order);
}







const showData = (items) => {

    const promises = [];

    for(let i = 0; i < items.length; i++) {
        const promise = $.ajax({
            url:  "../database/opinions.php",
            type: "GET",
            dataType: "json",
            data: {
                itemId: items[i].id
            }
        });
        
        promises.push(promise);
    }

    Promise.all(promises)
        .then(responses => {
            for(let i = 0; i < responses.length; i++) {
                makeHtml(items[i], responses[i]);
            }

            $(".item_list").html(productItem_html);
        })
        .catch(error => {
            console.log("Error receiving other data", error);
        });

}



let productItem_html ='';
const makeHtml = (item, opinions) => {
    const limit = 140;
    let truncatedReview = opinions.map(i => i.review.length > limit? i.review.slice(0,limit) + '...': i.review);
    let {description, detail, id, image, link, price, rating, title} = item;

    rating_as_star = star_html.repeat(rating);
    
    productItem_html = productItem_html.concat(`
    <div id=${`product`+id} class="item_box d-flex gap-4 flex-column flex-lg-row flex-grow-1">
<div class="item_box__des d-flex gap-4 flex-column flex-sm-row">
    <div class="item_box__des__img_frame">
        <img src="${image}" alt="img">
    </div>
    <div class="item_box__des_info pt-2 pt-md-4" >
        <ul class="item_box__des_info__ul p-0 gap-2">
            <li id="productRating" class="item_box__info__ul__item" value="price">
                ${rating_as_star}
            </li>
            <li id="productName" class="item_box__info__ul__item" value="name">
                ${title} 
            </li>
            <li id="productPrice" class="item_box__info__ul__item" value="price">${parseInt(price).toLocaleString('en-CA', { style: 'currency', currency: 'CAD' })}</li>
            <li id="productDescription" class="item_box__info__ul__item" value="description">
                ${user.user?detail: "Need to sign in to see description "}
            </li>
        </ul>
        <button class="item_box__button link" data-link="${link}">Buy</button>
    </div>
</div>
<div class="item_box__opinion pt-2 pt-md-4">
    <h5 style="padding-left:1rem; text-decoration: underline;">Review</h5>
    <ul class="item_box__opinion__ul gap-4">
        <li class="item_box__opinion__ul__item">
            ${truncatedReview[0]?truncatedReview[0]:''}
        </li>
        <li class="item_box__opinion__ul__item">
            ${truncatedReview[1]?truncatedReview[1]:''}
        </li>
        <li class="item_box__opinion__ul__item">
            ${truncatedReview[2]?truncatedReview[2]:''}
        </li>
    </ul>
    <button class="item_box__button opinion">More opinion</button>
</div>
</div>
    `);
    
    
}



/////////////////////////////////////////////////////////////////////////////


$(document).on("click", ".item_box__button.opinion", function() {
    if(!user.user) {
        window.location.href = "./login.php";

    }else {
        // Get the id of the clicked product using the closest() and attr() methods
        let id = $(this).closest(".item_box").attr("id");

        // Redirect to the product page with the id in the URL
        window.location.href = "./product.php?id="+id.slice(7);
    }
    
}).on("click", ".item_box__button.link", function() {
    var link = $(this).data("link");
    window.location.href = link;
});













            </script>
        </section>

        <hr>

        <nav aria-label="Page navigation ">
            <ul class="nav__pagination d-flex justify-content-center">
                
            </ul>
        </nav>

    </div>
    <div id="footer">
        <script src="../component/footer/footer.js"></script>
    </div>




    
</body>
</html>


