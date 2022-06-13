<?php
        require_once "config.php";

        $username = $password = $confirm_password = $email="" ;
        $username_err = $password_err = $confirm_password_err = $email_err= "";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            // check if username is empty
            if(empty(trim($_POST['username']))){
                $username_err = "Username cannot be blank";
            }
            else{
                $sql = "SELECT id FROM users WHERE username = ?";
                $stmt = mysqli_prepare($conn,$sql);
                if($stmt)
                  {
                    mysqli_stmt_bind_param($stmt, "s", $param_username);             
                   
                //    set the value of param_username
                     $param_username = trim($_POST['username']);

                // try to execute this statement
                    if(mysqli_stmt_execute($stmt)){
                      mysqli_stmt_store_result($stmt);
                      if(mysqli_stmt_num_rows($stmt)==1){
                       $username_err = "This username is already taken";
                        }
                    else{
                        $username = trim($_POST['username']);
                       }
                   }
                  else{
                    echo "Something went wrong";
                    }
                }
            }
            mysqli_stmt_close($stmt);
         

        // check for email
        if(empty(trim($_POST['email']))){
            $email_err = "email cannot be blank";
        }
        else{
            $sql = "SELECT id FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn,$sql);
            if($stmt)
              {
                mysqli_stmt_bind_param($stmt, "s", $param_email);             
               
            //    set the value of param_username
                 $param_email = trim($_POST['email']);

            // try to execute this statement
                if(mysqli_stmt_execute($stmt)){
                  mysqli_stmt_store_result($stmt);
                  if(mysqli_stmt_num_rows($stmt)==1){
                   $email_err = "An account already exist for this email";
                    }
                else{
                    $email = trim($_POST['email']);
                   }
               }
              else{
                echo "Something went wrong";
                }
            }
        }
        mysqli_stmt_close($stmt);
 

        // check for password
        if(empty(trim($_POST['password']))){
            $password_err = "Password cannot be blank";
        }
        elseif(strlen(trim($_POST['password']))<5){
            $password_err ="Password cannot be less than 5 characters";
        }
        else{
            $password = trim($_POST['password']);
        }

        // check for confirm password
        if(trim($_POST['password']) !=trim ($_POST['confirm_password'])){
             $password_err= "Passwords should match";
        }

        // if there were no errors, go ahead and insert into database
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)){
            $sql = "INSERT INTO users(username,email,password) VALUES(?,?,?)";
            $stmt = mysqli_prepare($conn,$sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt, "sss",$param_username,$param_email, $param_password);

                // set these parameters
                $param_email = $email;
                $param_username = $username;
                $param_password = password_hash($password,PASSWORD_DEFAULT);
                 
                // Try to execute the query
                if(mysqli_stmt_execute($stmt)){
                    header("location: login.php");
                }
                else{
                    echo "something went wrong...cannot redirect!";
                }
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="css/reg.css">
</head>

<body>
    <div class="container">
        <div class="fname">
            <h1 class="title">Registration form</h1>
        </div>
        <form action="" method="POST">
            <div class="name">
                <label for="name">name</label>
                <input type="text" name="username" id="name" required>
            </div>
            <!-- <div class="phone">
                <label for="mobile">mobile</label>
                <input type="tel" name="mobile" id="mobile" placeholder="Format : 1234-123-456" pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}" required>
            </div> <span class="span"><h3>or</h3></span> -->
            <div class="email">
                <label for="email">email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="password">
                <label for="password">password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="confirm password">
                <label for="confirm_password"> confirm password</label>
                <input type="password" name="confirm_password" id="confirm_password">
            </div>
            <div class="register">
                <input class="btn" role="button" type="submit" name="submit" id="" value="Register">

            </div>
            <div class="signup">
                <a href="login.php"> already have account? login</a>
            </div>
        </form>
    </div>


</body>

</html>