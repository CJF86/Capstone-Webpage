<?php

$servername = "localhost";
$username = "root";
$password = "Tt5b453h@66";
$database = "post-db";

session_start();

$user_id = $_SESSION['user_ID'];
$conn = new mysqli($servername,$username,$password,$database);

if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);

}

$postRefresh = "SELECT * FROM posts";

$postRefreshquery = mysqli_query($conn,$postRefresh);

/*
$postUser = "SELECT postedby FROM posts WHERE postedby IS NOT NULL";
$postInfo = "SELECT Post FROM posts WHERE Post IS NOT NULL";

$postUserquery = mysqli_query($conn,$postUser);
$postInfoquery = mysqli_query($conn,$postInfo);
*/
if(isset($_POST['submit']))
{
    $postData = mysqli_real_escape_string($conn,$_POST['info']);

    $postCommand = "INSERT INTO posts (Post, postedby) VALUES ('$postData','$user_id')";

    $postQuery = mysqli_query($conn,$postCommand);

    header('location:Capstone-homepage.php');
    
}

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="HomepageCSS.css" />
    <title></title>
</head>
<body>
    

    <div class="TopNav">
        <a href="Capstone-login.php">login</a>
        <a href="Capstone-registration.php">Register</a>
        <?php echo '<a href="Capstone-login.php" class="User">'.$user_id.'</a>' ?>
    </div>

    <div class="Posts">
        <h1>Latest posts</h1>

        <div class="latestPosts">
            <?php

            $postIteration = mysqli_fetch_assoc($postRefreshquery);

            echo '<p>'.$postIteration["postedby"].'</p>';
            echo '<p>'.$postIteration["Post"].'</p>';

            



            ?>

           
            <p>hello</p>
        </div>
        

        <form action="" method="post" enctype="multipart/form-data">

            <input type="text" name="info" placeholder="What's on your mind?" class="box"/>

            <input type="submit" name="submit" value="Post" class="btn"/>

        </form>

    </div>

    
    
    

</body>
</html>