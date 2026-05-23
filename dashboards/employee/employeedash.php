<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>
<style>
    @font-face {
        font-family: "new-york";
        src: url('../../new-york-font/NewYorkSmall-Regular.otf');
    }
    img{
        object-fit:cover;
    }
    body{
        font-family: "new-york";
    }
</style> 
<body class = "text-dark">
    <!-- Navbar for name -->
    <nav class="navbar navbar-expand-lg navbar-dark d-flexbox">
        <div class="container-fluid">
                <img src="../../images/OHAYOBREWLOGOLABEL.png" alt="" width = 150px height = 150px class = "img-fluid">

            </button>

                <div>
                         <img src= ""
                             class="rounded-circle me-2"
                             width="40"
                             height="40">
                </div>

            </div>
        </div>
    </nav>

    <div class="container" id = "">
        <div class="row">
            <div class="col">
                  <div class="container  border">
                    <div class="row ">
                        <h4>Hello, Employee!</h4>
                    </div>
                     <div class="row text-center border bg-secondary rounded-4 p-4 my-4">
                        <h5>Order List</h5>
                    </div>
                     <div class="row text-center p-4 my-4">
                        <h5><a href="products.php" class = "link-underline link-underline-opacity-0 text-dark">Products List</a></h5>
                    </div>
                     <div class="row text-center p-4 my-4">
                        <h5><a href="logs.php" class = "link-underline link-underline-opacity-0 text-dark">Logs</a></h5>
                    </div>
                  </div>
            </div>
             <div class="col-9">
                  <div class="container border">
                 <h1>Order Page</h1>
        </div>
            </div>
        </div>
    </div>
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>