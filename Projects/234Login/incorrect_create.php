<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
   <h1> CREATE ACCOUNT</h1>
   <br>
   <p>Username Already Exists</p>
    <form action ="create_check.php" method="POST" >
        <label for="user">Select A Username</label>
        <input type="text" id="user" name="username">
        <br>
        <label for="pass">Select A Password</label>
        <input type="password" id="pass" name="password">
        <br>
        <p>Already Have An Account? 
        <a href="index.php">Log In</a></p>
        <input class="w3-btn w3-blue w3-round" type="submit" type="submit" value="Submit" href="home.php">
    </form>

</body>
</html>