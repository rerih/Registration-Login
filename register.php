<?php 
require_once('config.php');
require_once('header.php');
require_once('connecting.php');

session_start();

if (isset($_POST['register']))
    register();


else 
    displayRegisterForm();

function register() {
    $username = !empty($_POST["username"]) ? trim($_POST["username"]) : null;
    $password = !empty($_POST["password"]) ? trim($_POST["password"]) : null;
    list($pass, $conn) = usernameChecking($username);
    if ($pass)
        displayRegisterForm("This username already exists!");
    else {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
        createNewAccount($conn, $username, $passwordHash);
        disconnect($conn);
        displayRegisterForm("You created new user, $username");
    }    
}

function displayRegisterForm($message = "") {
    displayPageHeader();
  
    ?>
    
    <div class="header">
    <?php
    if ($message) {
        ?>
        <h1> <?php echo $message ?></h1>
    <?php
    }
    ?>
    </div>
    <h2>Register</h2>
    <div class="logreg">
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="submit" name="register" value="Register" id="btn">
        </form>
    </div>
    </body>
    </html>
    <?php
}

