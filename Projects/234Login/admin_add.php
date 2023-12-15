
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

function view_user($username){
    global $pdo;

    $sql="SELECT id FROM pass_table WHERE username=?";
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

    $sql="SELECT password FROM pass_table WHERE username=?";
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

    $sql="SELECT id FROM pass_table WHERE username=?";
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

    $sql="DELETE FROM pass_table WHERE username=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$username]);
}
?>

<body>
   <h1>ADMIN PAGE</h1>

    <h3>ADMIN CONTROL</h3>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST['ausername'];
        $password=$_POST['apassword'];

        $dsn='mysql:host=localhost;dbname=my_db';
        $username_db="root";
        $password_db="root";

        try{
            $pdo= new PDO($dsn,$username_db,$password_db);
        }catch(PDOException $e){
            die("connection error".$e->getMessage());
        }
        
    }

    $user_exist_bool=user_exist($username,$password);

    if($user_exist_bool){
        echo "That User Already Exists";
    }else{
        $sql="INSERT INTO pass_table(username,password) VALUES(:username,:password)";
        $statement=$pdo->prepare($sql);
        
        $hashedPassword=password_hash($password,PASSWORD_BCRYPT);
        
        $statement->bindParam(':username',$username);
        $statement->bindParam(':password',$hashedPassword);
        
        $statement->execute();

        echo "User Successfully Added";

    }
    ?>
    <br><br>
    <a href="admin.php" style ="color : blue">Previous Page<a>
    <br>
    <br>

    <a href='logout.php'><button class='w3-btn w3-red w3-round' type='submit' type='button'>
        <p>Log Out</p>
    </button></a>
</body>
</html>