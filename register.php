<?php
@include 'config.php';
if(isset($_POST['submit'])){
    $name= mysqli_real_escape_string($conn, $_POST['submit']);
    $email= mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = ($_POST['user_type']);

    $select = "SELECT * FROM register_details WHERE email = '$email' && password = '$pass' ";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $error[] = 'user already exist!';
  
     }else{
  
        if($pass != $cpass){
           $error[] = 'password not matched!';
        }else{
           $insert = "INSERT INTO 'registration project'.'register_details'(name, email, password, register_details) VALUES('$name','$email','$pass','$user_type')";
           mysqli_query($conn, $insert);
           header('location:login.php');
        }
     }
    
    
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Register Now</h3>
            <?php
           if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
            ?>
            <input type="text" name="name" required placeholder="Enter your name">
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="password" name="cpassword" required placeholder="Enter your confirm password">
            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
        
    </div>
</body>
</html>