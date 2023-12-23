
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Home Page</title>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
</head>
<style>
h1,h2,h3,h4,h5,h6 {font-family: "Oswald"}
body {font-family: "Open Sans"}
</style>
<?php
session_start();
if($_SESSION['status'] != 'valid'){
    header("Location:index.php");
    exit();
}
?>

<body class="w3-blue-gray w3-center">
<header class="w3-container w3-center w3-padding-48">
    <h1 class="w3-xxxlarge"><b>HOME PAGE</b></h1>
    <h6>Created by <span class="w3-tag">Jacob Craven</span></h6>
</header>    

    <?php
    echo '<h3>Welcome '. $_SESSION['username']. '</h3>';
    echo '<h3>Your Session ID Is '.$_SESSION['id']. '</h3>';
    ?>
    <br>
    <p class = "w3-blue">Thank You For Your Submission!</p>

    <div class="w3-container w3-white w3-margin w3-padding-large w3-round-large">
        <div class="w3-center">
          <h3>Please Fill Out This Survey</h3>
        </div>

    <form action ="survey.php" method="POST" >
        <label for="st">What Is Your Favorite Sport?</label>
        <input type="text" id="st" name="sport">
        <br>
        <br>
        <label for="tm">What Is Your Favorite Team In That Sport?</label>
        <input type="text" id="tm" name="team">
        <br>
        <br>
        <label for="mov">What Is Your Favorite Movie?</label>
        <input type="text" id="mov" name="movie">
        <br>
        <br>
        <label for="char">Who Is The Main Character?</label>
        <input type="text" id="char" name="character">
        <br>
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    </div>
    <br>
    <br>

    <a href='logout.php'><button class='w3-btn w3-red w3-round' type='submit' type='button'>
        <p>Log Out</p>
    </button></a>
</body>
</html>