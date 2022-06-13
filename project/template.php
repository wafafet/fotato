<?php
  $flag = false;
  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false){
   $flag = false;
  }
  else{
    $flag = true;
  }
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="bootstrap/bootstrap.css" >
  <link rel="stylesheet" href="css/main.css">

  <title>fotato</title>

</head>

<body>
  <header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center col-md-3 ms-5 mb-md-0 text-dark text-decoration-none">
      <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="#" class="nav-link px-2 link-danger">Home</a></li>
      <li><a href="#" class="nav-link px-2 link-danger">Categories</a></li>
      <li><a href="#" class="nav-link px-2 link-danger">Foods</a></li>
      <li><a href="#" class="nav-link px-2 link-danger">Contact</a></li>
      <li><a href="#" class="nav-link px-2 link-danger">About</a></li>
    </ul>

    <div class="log col-md-3 me-4 text-end">
     <?php
         
         if($flag){
          
         echo" 
              
              <a href='logout.php' style='text-decoration:none;'>
              <button type='button' class='btn btn-outline-primary me-2'>Logout</button>
              </a>";

         }
         else
         {

           echo "<a href='login.php' style='text-decoration:none;'>
                 <button type='button' class='btn btn-outline-primary me-2'>Login</button>
                </a>
                 <a href='reg.php' style='text-decoration:none; color:white;'>
                 <button type='button' class='btn btn-primary '>Sign-up</button>
                 </a>";
         }
      ?>
     
    </div>
  </header>
<!-- searchbar -->

  <section class="food-search text-center">
    <div class="search-bar ">
      <form class="d-flex justify-content-center align-items-center " role="search">
        <input class="form-control me-2  " style="width: 40%;" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-white btn-danger " type="submit">Search</button>
      </form>
    </div>
  </section>

<!-- Categories -->

  <div class="Categories">
    <h1 class="text-center">Explore</h1>
    <div class="wrapper">

      <div class="box" style="width: 350px;">

        <a href="#" class="btn ">
          <img src="/fotato/images/pizza.jpg" class="card-img-top" alt="...">
        </a>
      </div>
      <div class="box" style="width: 350px;">
        <a href="#" class="btn ">
          <img src="/fotato/images/burger.jpg" class="card-img-top" alt="...">
        </a>
      </div>
      <div class="box" style="width: 350px;">
        <a href="#" class="btn ">
          <img src="/fotato/images/momo.jpg" class="card-img-top" alt="...">
        </a>
      </div>
    </div>
  </div>

  <!-- foodmenu -->


</body>

</html>