<?php
session_start();
if($_SESSION['status'] != 'valid'){
    header("Location:index.php");
    exit();
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];

    if($username== 'admin' && $password == 'admin'){
        header('Location: admin.php');
        $_SESSION['status'] = 'valid';
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

$sql="CREATE TABLE IF NOT EXISTS pass_table (
    id INT(7) NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
)";

$stmt=$pdo->prepare($sql);

if ($stmt->execute()){

}else {
    echo "error in creating the table".$stmt->error;
}
}

function user_exist($username,$password){
    global $pdo;

    $sql="SELECT password FROM pass_table WHERE username=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$username]);

    $info=$statement->fetch();

    if($info){
        $hashedPassword=$info['password'];

        if(password_verify($password,$hashedPassword))
        {
            return true;
        }else {return false;}
    }else{
        return false;
    }
}

$user_exist_bool=user_exist($username,$password);

$sql="SELECT id FROM pass_table WHERE username=?";
$statement=$pdo->prepare($sql);
$statement->execute([$username]);

$info=$statement->fetch();


if($user_exist_bool){
    session_start();
    $_SESSION["username"]=$username;
    $_SESSION["password"]=$password;
    $_SESSION["id"]= $info[0];
    $_SESSION["status"]='valid';
    header('Location: home.php');
}else{
    header('Location: incorrect_login.php');
}



$pdo=null;

?>
