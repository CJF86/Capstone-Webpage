<?php
$servername = "localhost";
$username = "root";
$password = "Tt5b453h@66";
$database = "post-db";

session_start();

echo '<link rel="stylesheet" href="HomepageCSS.css" />';

$user_id = $_SESSION['user_ID'];
$conn = new mysqli($servername,$username,$password,$database);

$postRefresh = "SELECT * FROM posts WHERE postedby='$user_id'";

$postRefreshquery = mysqli_query($conn,$postRefresh);

$postIteration = mysqli_fetch_assoc($postRefreshquery);

if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);

}

echo '<div class="TopNav">';

    echo '<a href="Capstone-login.php">login</a>';
    echo '<a href="Capstone-registration.php">Register</a>';
    echo '<a href="Capstone-homepage.php">Home</a>';
    echo '<a href="Capstone-userPage.php" class="User">Welcome back '.$user_id.'!</a>';
echo '</div>';

echo '<div class="Posts">';
    echo '<h1>Your Posts</h1>';

while($postIteration = mysqli_fetch_assoc($postRefreshquery))
{
    echo '<div class="postFormat">';
                
        echo '<p>'.$postIteration["postedby"].'<br>'.$postIteration["Post"].'</p>';
                
    echo '</div>';

}

echo '</div>';

?>