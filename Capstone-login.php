<?php

$servername = "localhost";
$username = "root";
$password = "Tt5b453h@66";
$database = "user-info";

$conn = new mysqli($servername,$username,$password,$database);

session_start();

if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);

}

if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $LoginCommand = "SELECT * FROM users WHERE Username = '$name' AND Password = '$password'";

    $LoginQuery = mysqli_query($conn,$LoginCommand);

    if(mysqli_num_rows($LoginQuery)==0)
    {
        $error[] = 'Please create an account';

    }
    if(mysqli_num_rows($LoginQuery)>0)
    {
        $CurrentUser = mysqli_fetch_assoc($LoginQuery);
        $_SESSION['user_ID'] = $CurrentUser['Username'];
        header('location:Capstone-homepage.php');

    }

    

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
        
        
        <form action="" method="post" enctype="multipart/form-data">
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
            
            <input type="text" name="name" placeholder="username" class="box"/>
            <input type="text" name="password" placeholder="password" class="box"/>
            <p>Don't have an account? register <a href="Capstone-registration.php">here</a></p>
            <input type="submit" name="submit" value="Login" class="btn"/>
            

        </form>


        

    </div>
    
    

</body>
</html>