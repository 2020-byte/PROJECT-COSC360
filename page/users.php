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

    <!-- Header Search Bar -->
    
    <link rel="stylesheet" href="../component/searchBar/searcBar.css">
    <header id="headerSearchBar" style="position: sticky; top: 0; z-index: 1;">
        <script src="../component/searchBar/searchBar.js" async></script>
    </header>

    <div class="mx-auto p-4" style="max-width:1200px; height: 100%;">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.html">Home</a></li>
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
        class="mx-auto p-5"
        >

        <div class="input-groupd d-flex gap-3 flex-column flex-md-row">
                <div class="form-outline d-flex align-items-md-center gap-3">
                    <label for="form1">Username</label>
                  <input type="search" id="form1" class="form-control" />
                </div>

                <div class="form-outline d-flex align-items-md-center gap-3">
                    <label class="form-label" for="form1">Email</label>
                  <input type="search" id="form1" class="form-control" />
                </div>
              

              <button type="button" class="btn btn-primary">
                <i class="fas fa-search"></i>
              </button>
        </div>

        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Dog</td>
                    <td>dog@gmail.com</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Cat</td>
                    <td>cat@gmail.com</td>
                    <td>Active</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Pig</td>
                    <td>pig@gmail.com</td>
                    <td>Active</td>
                </tr>
                <th scope="row">4</th>
                    <td>Horse</td>
                    <td>horse@gmail.com</td>
                    <td>Disabled</td>
            </tbody>
            </table>


        </div>
    </div>

    <div id="footer">
        <script src="../component/footer/footer.js"></script>
    </div>




    <div id="offCanvas"></div>

        
</body>
</html>