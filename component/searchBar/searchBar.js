
// $.ajax({
//     url: '../Auth/auth.php',
//     type: 'POST',
//     dataType: 'json',
//     success: function(response) {
//         console.log(response.userId);
//         console.log(response.email);
//         user.signIn(response.userId, response.email, true);
//     },
//     error: function(xhr, status, error) {
//       // code to run if AJAX request fails
//       console.log('AJAX request failed');
//     },
//     complete: function(xhr, status) {
//       // code to run regardless of whether AJAX request succeeds or fails
//       console.log('AJAX request completed');
//     }
//   })



//   $.ajax({
//     url: '../Auth/auth.php',
//     type: 'HEAD',
//     success: function() {
//       console.log('URL is available');
//     },
//     error: function() {
//       console.log('URL is not available');
//     }
//   });



const searchbar_html = `
<div class="search-background">
<nav class="d-flex justify-content-center">
    <div class="nav__box d-flex align-items-center">
        <button id="toggleSideBar" class="btn menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas"><i class="fa-solid fa-bars"></i></button>
        <a class="navbar-brand m-1 m-md-2" href="./index.php"><img src="../img/camel.png" alt="logo"></a>
        <form action="../database/test.php" method="GET" class="nav__form">
            <input  id="searchbar" type="search" name="search" class="nav__form__child" placeholder="Search" aria-label="Search">
            <button type="submit" class="nav__form__child"><i class="fa-solid fa-lg fa-magnifying-glass nav__form__child"></i></button>
        </form>
        
        <div class="dropdown ms-auto">
            <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" 
                    href=${
                        auth.auth?'./users.php': user.user?'./profile.php':'./signup.php'
                    }>
                        ${auth.auth?'Managing Users':user.user?`Edit Profile`: `Create Free Account`}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" id="signOut"  style="cursor:pointer;"
                    
                    ${user.user?'':"href='./login.php'"}
                    >
                    ${user.user?`Sign out`:`Sign In`}
                    </a>
                </li>                      
            </ul>
        </div>
    </div>
</nav>
</div>
`



const logOut = () => {
    if(!user.user) return;
    var confirmed = confirm("Are you sure you want to proceed?");
    // if the user clicks "OK", do something
    if (confirmed) {
        $.ajax({
            url: '../Auth/logout.php',
            type: 'POST',
            success: function(response) {
                console.log('Session destroyed');
                user.signOut();
                window.location.href = "./index.php";
                console.log(user.user);
            }
        });     
    }
};




$('#headerSearchBar').html(
    `
    ${searchbar_html}
    `
)
const urlParams = new URLSearchParams(window.location.search);
const search = urlParams.get('search');
    

$('#searchbar').val(search);


$(document).ready(() => {
    $(`#offCanvas`).html(
        `
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel" >
            <div class="offcanvas-header p-2">
                <h6 class="offcanvas-title" id="offcanvasLabel">Welcome!</h6>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
            </div>
            <hr class="mx-0 w-75">
    
                       
            <a  href=${
                auth.auth?'./users.php': user.user?'./profile.php':'./signup.php'
            }>
                ${auth.auth?'Managing Users':user.user?`Edit Profile`: `Create Free Account`}
            </a>
            <a style="cursor:pointer;" id="logOut"
                        
            ${user.user?'':"href='./login.php'"}
            >
            ${user.user?`Sign out`:`Sign In`}
            </a>
        </li>      
        </div>
        `
    )
})

$("nav form button").click(e => {
    e.preventDefault();
    const searchValue = $('#searchbar').val();
    window.location.href = `./productSearch.php?search=${searchValue}`;
    
});



$(".nav__form").click(() => {
    $(".nav__form").addClass('nav__form-clicked');
})


$(document).click(e => {
    const name = e.target.className;
    
    if( name.includes("nav__form__child")) {
        return;
    } else{
        $(".nav__form").removeClass('nav__form-clicked');
    }
});


$(document).ready(() => {
    $('#signOut').click(logOut);
    $('#logOut').click(logOut);
});





