<?php

$servername = "localhost";
$username = "root";
$password = "Tt5b453h@66";
$database = "webapp_final";
$NotloggedIn = "no";

$conn = new mysqli($servername,$username,$password,$database);

if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);

}

echo "Connected successfully";

if(isset($_POST['submit']))
{
    echo "posting";
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $c_password = mysqli_real_escape_string($conn,$_POST['confirmpassword']);

    $DupCheck = "SELECT * FROM user_table WHERE Username = '$name' AND Password = '$password' AND Email = '$email'";

    $DupResult = mysqli_query($conn,$DupCheck);

    if(mysqli_num_rows($DupResult)>0)
    {
        $error[] = 'User already exists';

    }
    elseif($password != $c_password)
    {
        $error[] = 'Passwords do not match';
    }
    else
    {
        $insert = "INSERT INTO user_table (Username, Password, Email, CPassword,loginStatus) VALUES ('$name','$password','$email','$c_password','$NotloggedIn')";

        if(!mysqli_query($conn,$insert))
        {
            echo "error: " . mysqli_error($conn);

        }

        header('location:Capstone-login.php');

    }


}else
{
    echo "Not committing";

}

?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="LoginCSS.css" />
    <title></title>
</head>
<body>
    
    <div class="header">
        
    </div>
    <div class="Login">
        
        <form  method="post" action="">
            <h1>Welcome!</h1>

            <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                    echo '<span class="error-msg">'.$error.'</span>';

                }
            }

            ?>
            <input type="text" name="email" placeholder="email address" class="box"/>
            <input type="text" name="name" placeholder="username" class="box"/>
            <input type="text" name="password" placeholder="password" class="box"/>
            <input type="text" name="confirmpassword" placeholder="confirm password" class="box"/>
            <p>Already a user? login <a href="Capstone-login.php">here</a></p>
            <input type="submit" name="submit" value="Login" class="btn"/>
        </form>
        
    </div>
    
    

</body>
</html>
