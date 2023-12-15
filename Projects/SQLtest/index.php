<?php

$dsn='mysql:host=localhost;dbname=if0_35447805_my_db';
$username_db="if0_35447805";
$password_db="6DSETUWO9wv";

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
?>