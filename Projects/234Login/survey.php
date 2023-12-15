<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sport=$_POST['sport'];
    $team=$_POST['team'];
    $movie=$_POST['movie'];
    $character=$_POST['character'];


$dsn='mysql:host=localhost;dbname=my_db';
$username_db="root";
$password_db="root";

try{
    $pdo= new PDO($dsn,$username_db,$password_db);
}catch(PDOException $e){
    die("connection error".$e->getMessage());
}

$sql="CREATE TABLE IF NOT EXISTS sports_table (
    sport VARCHAR(255) NOT NULL,
    team VARCHAR(255) NOT NULL,
    id INT(7) NOT NULL,
    FOREIGN KEY(id) REFERENCES pass_table(id)
)";

$stmt=$pdo->prepare($sql);

if ($stmt->execute()) {
    echo "Sport Table created successfully";
} else {
    echo "Error in creating the sport table: " . $stmt->errorCode() . ": " . $stmt->errorInfo()[2];
}

$sql="CREATE TABLE IF NOT EXISTS movie_table (
    movie VARCHAR(255) NOT NULL,
    main_character VARCHAR(255) NOT NULL,
    id INT(7) NOT NULL,
    FOREIGN KEY(id) REFERENCES pass_table(id)
)";

$stmt=$pdo->prepare($sql);

if ($stmt->execute()) {
    echo "movie Table created successfully";
} else {
    echo "Error in creating the movie table: " . $stmt->errorCode() . ": " . $stmt->errorInfo()[2];
}
}

$id = $_SESSION['id'];

function id_verify($id){
    global $pdo;

    $sql="SELECT sport FROM sports_table WHERE id=?";
    $statement=$pdo->prepare($sql);
    $statement->execute([$id]);

    $info=$statement->fetch();

    if($info){
        return true;
    }else{
        return false;
    }
}

$id_exist=id_verify($id);

if($id_exist){
    header("Location: survey_deny.php");
}else{

    $sql="INSERT INTO sports_table(id,sport,team) VALUES(:id,:sport,:team)";
    $statement=$pdo->prepare($sql);

    $statement->bindParam(':id',$id);
    $statement->bindParam(':sport',$sport);
    $statement->bindParam(':team',$team);

    $statement->execute();

    $sql="INSERT INTO movie_table(id,movie,main_character) VALUES(:id,:movie,:main_character)";
    $statement=$pdo->prepare($sql);

    $statement->bindParam(':id',$id);
    $statement->bindParam(':movie',$movie);
    $statement->bindParam(':main_character',$character);

    $statement->execute();

    $sql = 'SELECT pass_table.username, sports_table.sport, sports_table.team, movie_table.movie, movie_table.main_character FROM pass_table 
    JOIN sports_table ON pass_table.id = sports_table.id
    JOIN movie_table ON pass_table.id = movie_table.id';

    $statement = $pdo->prepare($sql);
    $statement->execute();

    header("Location: survey_thanks.php");
}



$pdo=null;

echo "done";

?>
