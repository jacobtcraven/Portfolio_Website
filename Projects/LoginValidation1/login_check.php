<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];

    if($username== 'admin' && $password == 'admin'){
        $_SESSION['status'] = 'valid';
        $_SESSION['username'] = $username;
        header('Location: admin.php');
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

$sql="CREATE TABLE IF NOT EXISTS registration (
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

    $sql="SELECT password FROM registration WHERE username=?";
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

$sql="SELECT id FROM registration WHERE username=?";
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
