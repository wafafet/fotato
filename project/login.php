<?php
    //  This script will handle login
    session_start();
    $incorrect = false;
    
    // check if the user is already logged in
    if(isset($_SESSION['username'])){
        header("location: index.php");
        exit;
    }
    require_once "config.php";
    
    $username = $password = "";
    $err = "";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
        {
            $err = "Please Enter Username and Password";
        }
     else{
      
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
        }


    if(empty($err))
        {
           $sql = "SELECT id, username, email, password FROM users WHERE username = ?";
           $stmt = mysqli_prepare($conn, $sql);
           mysqli_stmt_bind_param($stmt, "s", $param_username);
           $param_username = $username;

           if(mysqli_stmt_execute($stmt)){

              mysqli_stmt_store_result($stmt);

              if(mysqli_stmt_num_rows($stmt)==1){

                       mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password);
                
                       if(mysqli_stmt_fetch($stmt))
                       {
                            
                             if(password_verify( $password, $hashed_password))
                             {
                              
                                //this means that password is correct. Allow user to login.
                                session_start();
                                $_SESSION["username"] = $username;
                                $_SESSION["id"] = $id;
                                $_SESSION["loggedin"] = true;
                                $_SESSION["email"] = $email;

                                // redirect user to homepage
                                header("location: index.php");
                             
                             }
                             else{
                              
                                $incorrect = true;
                             }
                       }
              }
           }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
        <div class="fname">
            <h1 class="title">login form</h1>
        </div>
        <form action="" method="POST">
            <?php
             if($incorrect){
                echo "<li style='list-style-type: none;'> Incorrect password or Username</li> ";
             }
            ?>
            <div class="name">
                <label for="name">username</label>
                <input type="text" name="username" id="name">
            </div>
             <!-- <div class="phone">
                <label for="mobile">mobile</label>
                <input type="tel" name="mobile" id="mobile" placeholder="Format : 1234-123-456" pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}" required>
            </div>  -->
             <span class="span"><h3>or</h3></span>  
            <div class="email">
                <label for="email">email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="password">
                <label for="password">password</label>
                <input type="password" name="password" id="password">
            </div>
        
            <div class="login">
                <input class="btn" role="button" type="submit" name="login" id="login" value="login">

            </div>
            <div class="signup">
                <a href="reg.php"> Not Registered yet ? signup</a>
            </div>
        </form>
    </div>

</body>
</html>