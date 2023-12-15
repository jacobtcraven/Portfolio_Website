<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
   <h1> LOGIN INFORMATION</h1>
   <br>
    <form action ="login_check.php" method="POST">
        <p>Incorrect Login Information</p>
        <label for="user">Input Your Username</label>
        <input type="text" id="user" name="username">
        <br>
        <label for="pass">Input Your Password</label>
        <input type="password" id="pass" name="password">
        <br>
        <p>Don't Have An Account? 
        <a href="create.php">Create An Account</a></p>
        <input class="w3-btn w3-blue w3-round" type="submit" type="submit" value="Submit">
    </form>
</body>
</html>