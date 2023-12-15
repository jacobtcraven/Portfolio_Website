<?php
session_start();
if($_SESSION['status'] != 'valid'){
    header("Location:index.php");
    exit();
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];


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
    echo "table created successfully";
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
        return true;
    }else {
        return false;
    }
}

$user_exist_bool=user_exist($username,$password);

if($user_exist_bool){
    header("Location: incorrect_create.php");
    exit();
}else{
    $sql="INSERT INTO pass_table(username,password) VALUES(:username,:password)";
    $statement=$pdo->prepare($sql);
    
    $hashedPassword=password_hash($password,PASSWORD_BCRYPT);
    
    $statement->bindParam(':username',$username);
    $statement->bindParam(':password',$hashedPassword);
    
    $statement->execute();

    header('Location: index.php');
}



$pdo=null;

?>
