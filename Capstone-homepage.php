<?php

$servername = "localhost";
$username = "root";
$password = "Tt5b453h@66";
$database = "webapp_final";
//$UserDB = "user-info";
$NotloggedIn = "no";

session_start();

echo '<link rel="stylesheet" href="HomepageCSS.css" />';

$user_id = $_SESSION['user_ID'];
$conn = new mysqli($servername,$username,$password,$database);
//$Userconn = new mysqli($servername,$username,$password,$UserDB);

$NoLogin = "UPDATE user_table SET loginStatus = '$NotloggedIn' WHERE Username = '$user_id'";

if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);

}

$postRefresh = "SELECT * FROM post_table";

$postRefreshquery = mysqli_query($conn,$postRefresh);

if(isset($_POST['submit']))
{
    $postData = mysqli_real_escape_string($conn,$_POST['info']);

    $postCommand = "INSERT INTO post_table (Post, PostedBy) VALUES ('$postData','$user_id')";

    $postQuery = mysqli_query($conn,$postCommand);

    if(!mysqli_query($conn,$postQuery))
        {
            echo "error: " . mysqli_error($conn);

        }

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
        
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="searchText" placeholder="search users" class="Search"/>
            <input type="submit" name="searchSubmit" value="Search"/>
            <input type="submit" name="Logout" value="log out"/>
        </form>
        <?php

        if(isset($_POST['Logout']))
        {
            $LoginUpdateQuery = mysqli_query($conn,$NoLogin);
            header('location:Capstone-login.php');

        }

        if(isset($_POST['searchSubmit']))
        {
            $searchedName = mysqli_real_escape_string($conn,$_POST['searchText']);
            $userSearchcommand = "SELECT * FROM user_table WHERE Username = '$searchedName'";
            $userSearchquery = mysqli_query($conn,$userSearchcommand);

            if(mysqli_num_rows($userSearchquery)==0)
            {
                echo '<span class="error-msg">This user does not exist</span>';

            }
            else
            {
                $Searcheduser = mysqli_fetch_assoc($userSearchquery);

                $_SESSION['search_ID'] = $Searcheduser['Username'];
                header('location:Capstone-searchedUserpage.php');



            }


        }

        ?>
        <?php echo '<a href="Capstone-userPage.php" class="User">Welcome back '.$user_id.'!</a>' ?>
    </div>

    <div class="Posts">
        <h1>Latest posts</h1>

        <div class="latestPosts">
            
            <?php
            
            //$postIteration = mysqli_fetch_assoc($postRefreshquery);
            
            

            while($postIteration = mysqli_fetch_assoc($postRefreshquery))
            {
                echo '<div class="postFormat">';
                
                    echo '<p>'.$postIteration["PostedBy"].'<br>'.$postIteration["Post"].'</p>';
                
                echo '</div>';

            }

            ?>
            
        </div>
        

        <form action="" method="post" enctype="multipart/form-data">

            <input type="text" name="info" placeholder="What's on your mind?" class="box"/>

            <input type="submit" name="submit" value="Post" class="btn"/>

        </form>

    </div>

    
    
    

</body>
</html>