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



  echo '<script>user.signIn("username","'.$_SESSION['email'].'", true);</script>';
  echo '<script>console.log("'.$_SESSION['user_id'].'")</script>';

  if ($_SESSION['user_id'] == 1 ) {
    echo '<script>console.log("'.$_SESSION['user_id'].'")</script>';


    echo '<script>auth.signIn("username","'.$_SESSION['email'].'", true, true);</script>';

}else {
    // Redirect to authorized page
  header("Location: ./index.php");
  exit();
}
} 
?>
<a id="scrollTopButton"></a>
<link rel="stylesheet" href="..\component\scrollTop\scrollTopButton.css">
<style>
#scrollTopButton {
    display: inline-block;
    background-color: #FF9800;
    width: 50px;
    height: 50px;
    text-align: center;
    border-radius: 4px;
    position: fixed;
    bottom: 30px;
    right: 30px;
    transition: background-color .3s, 
      opacity .5s, visibility .5s;
    opacity: 0;
    visibility: hidden;
    z-index: 1000;
    text-decoration: none;
  }
  #scrollTopButton::after {
    content: "\f077";
    font-family: FontAwesome;
    font-weight: normal;
    font-style: normal;
    font-size: 2em;
    line-height: 50px;
    color: #fff;
  }
  #scrollTopButton:hover {
    cursor: pointer;
    background-color: #333;
  }
  #scrollTopButton:active {
    background-color: #555;
  }
  #scrollTopButton.show {
    opacity: 1;
    visibility: visible;
  }
  
  /* Styles for the content section */
  

  @media (min-width: 500px) {

    #scrollTopButton{
      margin: 30px;
    }
  }
</style>
<script src="..\component\scrollTop\scrollTopButton.js"></script>
<script>
var btn = $('#scrollTopButton');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '100');
});
</script>


<body style="min-height:100vh;">

    <!-- Header Search Bar -->
    
    <link rel="stylesheet" href="../component/searchBar/searcBar.css">
    <header id="headerSearchBar" style="position: sticky; top: 0; z-index: 1;">
        <script src="../component/searchBar/searchBar.js" async></script>
    </header>

    <div class="mx-auto p-4" style="max-width:1200px; height: 100%; min-height:700px">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="Product">Users Info</li>
            </ol>
        </nav>

        <hr>
        
        <div 
        style="
        max-width: 900px;
        border-radius: 0.375rem;
        background-color: rgb(241, 235, 204);
        box-shadow: rgba(110, 155, 191, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        "
        class="mx-auto p-5 d-flex flex-column"
        >

        <div class="input-groupd d-flex gap-3 flex-column flex-md-row">
                <div class="form-outline d-flex align-items-md-center gap-3">
                    <label for="form1">Username</label>
                  <input type="search" id="username" class="form-control" />
                </div>

                <div class="form-outline d-flex align-items-md-center gap-3">
                    <label class="form-label" for="form1">Email</label>
                  <input type="search" id="email" class="form-control" />
                </div>
              

              <button id="searchButton" type="button" class="btn btn-primary">
                <i class="fas fa-search"></i>
              </button>
        </div>

        <script>
            let userTable_html = "";
             let userTable_Starthtml = `
            <table id="userTable" class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>

            `

            const showData = (response) => {
                for(let i = 0; i < response.length; i++) {
                    let {id, username, email, status} = response[i];
                    userTable_html = userTable_html.concat(`
                    <tr>
                    <th scope="row">${i+1}</th>
                    <td>${username}</td>
                    <td>${email}</td>
                    <td class="userId" id="${id}" data-status="${status}" style="cursor:pointer; color: ${status==1?"green":"red"}">${status==1?"Active": "disabled"}</td>
                    <style>
                    .userId:hover { 
                        font-size:1.2rem; 
                       }
                    </style>
                </tr>
                    `)
                }
            }

            const changeStatus = (id, status) => {
                // Get the query string
                var queryString = window.location.search;
                    $.ajax({
                    url:  "../database/changeStatus.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        userId: id,
                        status: status,
                    },
                    success: function(response) {
                        // Update the HTML with the fetched data
                        console.log("changed");
                        // Redirect to the same page with the query string
                    
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.log("Error: " + error);
                        console.log(xhr);

                    },
                    complete: function() {
                        window.location.href = window.location.pathname + queryString;

                    }
                    });
            }


            let username = "";
            let email = "";

            const asyncData = (username, email) => {
                $.ajax({
                url:  "../database/manageUsers.php",
                type: "GET",
                dataType: "json",
                data: {
                    username: username,
                    email: email,
                },
                success: function(response) {
                    // Update the HTML with the fetched data
                    userTable_html = userTable_Starthtml;
                    showData(response);

                    userTable_html = userTable_html.concat("</tbody>");
                    $("#userTable").html(userTable_html);

                    $(".userId").click((e) => {
                        const id = $(e.target).attr("id");
                        console.log(id);
                        const status = $(e.target).attr("data-status");
                        changeStatus(id, status)
                        
                    });
                
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.log("Error: " + error);
                }
                });
            }

            

            $(document).ready(function() {
                $("#searchButton").click(() => {
                
                    username = $("#username").val();
                    email = $("#email").val();
                    console.log(username);
                    asyncData(username, email);
                });

                $('#username, #email').keypress(function(e) {
                if (e.keyCode == 13) {
                    $('#searchButton').click();
                }
                });
            });

            asyncData(username, email);
           

           

           
           
        </script>

        <table id="userTable" class="table table-striped d-flex justify-cotent-center">
            
            
            
            </table>


        </div>
    </div>

    <div id="footer">
        <script src="../component/footer/footer.js"></script>
    </div>




    <div id="offCanvas"></div>

        
</body>
</html>