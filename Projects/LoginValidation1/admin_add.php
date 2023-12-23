
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
$pdo = "";
function view_user($username){
    global $pdo;

    $sql="SELECT id FROM registration WHERE username=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$username]);

    $id_fetch=$statement->fetch();

    $id = $id_fetch[0];

    $sql="SELECT sport FROM sports_table WHERE id=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$id]);

    $sport_bool=$statement->fetch();

    if($sport_bool){
        $sport = $sport_bool[0];
    }else{
        $sport = "No Answer Given";
    }

    $sql="SELECT team FROM sports_table WHERE id=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$id]);

    $team_bool=$statement->fetch();

    if($team_bool){
        $team = $team_bool[0];
    }else{
        $team = "No Answer Given";
    }

    $sql="SELECT movie FROM movie_table WHERE id=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$id]);

    $movie_bool=$statement->fetch();

    if($movie_bool){
        $movie = $movie_bool[0];
    }else{
        $movie = "No Answer Given";
    }

    $sql="SELECT main_character FROM movie_table WHERE id=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$id]);

    $char_bool=$statement->fetch();

    if($char_bool){
        $char = $char_bool[0];
    }else{
        $char = "No Answer Given";
    }



    echo "Username: ". $username . "<br>";
    echo "Favorite Sport: ". $sport ."<br>";
    echo "Favorite Team: ". $team ."<br>";
    echo "Favorite Movie: ". $movie ."<br>";
    echo "Main Character In Favorite Movie: ". $char ."<br>";
}

function user_exist($username){
    global $pdo;

    $sql="SELECT password FROM registration WHERE username=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$username]);

    $info=$statement->fetch();

    if($info){
        return true;
    }else {
        return false;
    }
}

function add_user($username){
    global $pdo;

    $sql="SELECT id FROM registration WHERE username=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$username]);

    $id_fetch=$statement->fetch();

    $id = $id_fetch[0];

    $sql="DELETE FROM sports_table WHERE id=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$id]);

    $sql="DELETE FROM movie_table WHERE id=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$id]);

    $sql="DELETE FROM registration WHERE username=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$username]);
}
?>

<body class="w3-blue-gray w3-center">
<header class="w3-container w3-center w3-padding-48">
    <h1 class="w3-xxxlarge"><b>ADMIN PAGE</b></h1>
    <h6>Created by <span class="w3-tag">Jacob Craven</span></h6>
</header> 
<div class="w3-container w3-white w3-margin w3-padding-large w3-round-large">

    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST['ausername'];
        $password=$_POST['apassword'];

        $dsn='mysql:host=sql313.infinityfree.com;dbname=if0_35447805_db_login';
        $username_db="if0_35447805";
        $password_db="6DSETUWO9wv";

        try{
            $pdo= new PDO($dsn,$username_db,$password_db);
        }catch(PDOException $e){
            die("connection error".$e->getMessage());
        }
        
    }

    $user_exist_bool=user_exist($username,$password);

    if($user_exist_bool){
        echo "<h3>That User Already Exists</h3>";
    }else{
        $sql="INSERT INTO registration(username,password) VALUES(:username,:password)";
        $statement=$pdo->prepare($sql);
        
        $hashedPassword=password_hash($password,PASSWORD_BCRYPT);
        
        $statement->bindParam(':username',$username);
        $statement->bindParam(':password',$hashedPassword);
        
        $statement->execute();

        echo "<h3>User Successfully Added</h3>";

    }
    ?>
    </div>
    <a href="admin.php" style ="color : blue">Previous Page<a>
    <br>
    <br>

    <a href='logout.php'><button class='w3-btn w3-red w3-round' type='submit' type='button'>
        <p>Log Out</p>
    </button></a>
</body>
</html>