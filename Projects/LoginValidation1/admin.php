
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Admin Page</title>
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

$dsn='mysql:host=sql313.infinityfree.com;dbname=if0_35447805_db_login';
$username_db="if0_35447805";
$password_db="6DSETUWO9wv";

try{
    $pdo= new PDO($dsn,$username_db,$password_db);
}catch(PDOException $e){
    die("connection error".$e->getMessage());
}
?>

<body class="w3-blue-gray w3-center">
<header class="w3-container w3-center w3-padding-48">
    <h1 class="w3-xxxlarge"><b>ADMIN PAGE</b></h1>
    <h6>Created by <span class="w3-tag">Jacob Craven</span></h6>
</header>    
    <?php
    echo '<h3>Welcome '. $_SESSION['username']. '</h3>';
    echo '<h3>Your Session ID Is '.$_SESSION['id']. '</h3>';
    ?>

    <div class="w3-container w3-white w3-margin w3-padding-large w3-round-large">
        <div class="w3-center">
          <h3>ADMIN CONTROL</h3>
        </div>
    <form action ="admin_view.php" method="POST" >
        <label for="view">View User Info<br>Enter Username</label>
        <input type="text" id="view" name="vusername">
        <br>
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    <br>
    <form action ="admin_delete.php" method="POST" >
        <label for="delete">Delete User<br>Enter Username</label>
        <input type="text" id="delete" name="dusername">
        <br>
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    <br>
    <form action ="admin_add.php" method="POST" >
        <label for="add">Add User<br>Enter Username</label>
        <input type="text" id="add" name="ausername">
        <br>
        <br>
        <label for="pass">Select A Password</label>
        <input type="password" id="pass" name="apassword">
        <br>
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    <br>
    <form action ="admin_update.php" method="POST" >
        <label for="update">Update User<br>Enter Username</label>
        <input type="text" id="update" name="uusername">
        <br>
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    <br>
    <?php
   $sql = "SELECT username FROM registration";
   $statement = $pdo->prepare($sql);
   $statement->execute();
   
   $usernames = $statement->fetchAll();
   
   if ($usernames) {
       echo "List Of Usernames:<br>";
   
       foreach ($usernames as $row) {
           echo $row['username'] . "<br>";
       }
   } else {
       echo "No usernames found.";
   }
    ?>
    </div>

    <a href='logout.php'><button class='w3-btn w3-red w3-round' type='submit' type='button'>
        <p>Log Out</p>
    </button></a>
</body>
</html>