
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Admin Page</title>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
</head>
<?php
session_start();
if($_SESSION['status'] != 'valid'){
    header("Location:index.php");
    exit();
}

$dsn='mysql:host=localhost;dbname=my_db';
$username_db="root";
$password_db="root";

try{
    $pdo= new PDO($dsn,$username_db,$password_db);
}catch(PDOException $e){
    die("connection error".$e->getMessage());
}
?>

<body>
   <h1>ADMIN PAGE</h1>

    <br>
    <?php
    echo '<p>Welcome '. $_SESSION['username']. '</p>';
    echo '<p>Your Session ID Is '.$_SESSION['id']. '</p>';
    ?>
    <br>

    <h3>ADMIN CONTROL</h3>
    <form action ="admin_view.php" method="POST" >
        <label for="view">View User Info<br>Enter Username</label>
        <input type="text" id="view" name="vusername">
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    <br>
    <form action ="admin_delete.php" method="POST" >
        <label for="delete">Delete User<br>Enter Username</label>
        <input type="text" id="delete" name="dusername">
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    <br>
    <form action ="admin_add.php" method="POST" >
        <label for="add">Add User<br>Enter Username</label>
        <input type="text" id="add" name="ausername">
        <br>
        <label for="pass">Select A Password</label>
        <input type="password" id="pass" name="apassword">
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    <br>
    <form action ="admin_update.php" method="POST" >
        <label for="update">Update User<br>Enter Username</label>
        <input type="text" id="update" name="uusername">
        <br>
        <input class="w3-btn w3-blue w3-round" type="submit" value="Submit" >
    </form>
    <br>
    <br>
    <?php
   $sql = "SELECT username FROM pass_table";
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
    <br><br>

    <a href='logout.php'><button class='w3-btn w3-red w3-round' type='submit' type='button'>
        <p>Log Out</p>
    </button></a>
</body>
</html>