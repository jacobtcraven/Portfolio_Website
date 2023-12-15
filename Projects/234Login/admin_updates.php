
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
    $usport=$_POST['usport'];

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

$sql="SELECT sport FROM sports_table WHERE id=?";
$statement=$pdo->prepare($sql);
$statement->execute([$id]);

$info=$statement->fetch();

echo "before";

if($info){
    echo "right";
    $sql = "UPDATE sports_table SET sport = :nsport WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':nsport', $usport);
    $statement->bindParam(':id', $id);
    $statement->execute();
}else {
    echo "wrong";
    $team = "No Answer Given";
    $sql="INSERT INTO sports_table(id,sport,team) VALUES(:id,:sport,:team)";
    $statement=$pdo->prepare($sql);

    $statement->bindParam(':id',$id);
    $statement->bindParam(':sport',$usport);
    $statement->bindParam(':team',$team);

    $statement->execute();

}

header('Location: admin_update.php');
exit();

?>
