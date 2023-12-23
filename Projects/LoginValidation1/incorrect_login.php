<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<style>
h1,h2,h3,h4,h5,h6 {font-family: "Oswald"}
body {font-family: "Open Sans"}
</style>
<body class="w3-blue-gray w3-center">
<header class="w3-container w3-center w3-padding-48">
    <h1 class="w3-xxxlarge"><b>LOGIN INFORMATION</b></h1>
    <h6>Created by <span class="w3-tag">Jacob Craven</span></h6>
</header>
    <form action ="login_check.php" method="POST">
        <p>Incorrect Login Information</p>
        <label for="user">Input Your Username</label>
        <input type="text" id="user" name="username">
        <br>
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