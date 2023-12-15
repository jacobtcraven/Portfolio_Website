
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

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $umovie=$_POST['umovie'];

    $dsn='mysql:host=localhost;dbname=my_db';
    $username_db="root";
    $password_db="root";

    try{
        $pdo= new PDO($dsn,$username_db,$password_db);
    }catch(PDOException $e){
        die("connection error".$e->getMessage());
    }
    
}

$username = $_SESSION["update"];

$sql="SELECT id FROM pass_table WHERE username=?";
$statement=$pdo->prepare($sql);
$statement->execute([$username]);

$id_fetch=$statement->fetch();

$id = $id_fetch[0];


$sql="SELECT movie FROM movie_table WHERE id=?";
$statement=$pdo->prepare($sql);
$statement->execute([$id]);

$info=$statement->fetch();


if($info){
    $sql = "UPDATE movie_table SET movie = :nsport WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':nsport', $umovie);
    $statement->bindParam(':id', $id);
    $statement->execute();
}else {
    $char = "No Answer Given";
    $sql="INSERT INTO movie_table(id,movie,main_character) VALUES(:id,:movie,:chara)";
    $statement=$pdo->prepare($sql);

    $statement->bindParam(':id',$id);
    $statement->bindParam(':movie',$umovie);
    $statement->bindParam(':chara',$char);

    $statement->execute();

}

header('Location: admin_update.php');
exit();

?>
