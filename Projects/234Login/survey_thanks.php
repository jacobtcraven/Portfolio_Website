
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Home Page</title>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
</head>
<?php
session_start();
if($_SESSION['status'] != 'valid'){
    header("Location:index.php");
    exit();
}
?>

<body>
   <h1> HOME PAGE</h1>

    <br>
    <?php
    echo '<p>Welcome '. $_SESSION['username']. '</p>';
    echo '<p>Your Session ID Is '.$_SESSION['id']. '</p>';
    ?>
    <br>
    <p class = "w3-blue">Thank You For Your Submission!</p>

    <h3>Please Fill Out This Survey</h3>
    <form action ="survey.php" method="POST" >
        <label for="st">What Is Your Favorite Sport?</label>
        <input type="text" id="st" name="sport">
        <br>
        <label for="tm">What Is Your Favorite Team In That Sport?</label>
        <input type="text" id="tm" name="team">
        <br>
        <label for="mov">What Is Your Favorite Movie?</label>
        <input type="text" id="mov" name="movie">
        <br>
        <label for="char">Who Is The Main Character?</label>
        <input type="text" id="char" name="character">
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    <br>
    <br>

    <a href='logout.php'><button class='w3-btn w3-red w3-round' type='submit' type='button'>
        <p>Log Out</p>
    </button></a>
</body>
</html>