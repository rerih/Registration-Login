<?php
require_once('config.php');
require_once('header.php');
require_once('connecting.php');

session_start();



if (isset($_POST['login'])) {
    login();
}
elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
    logout();
}

else
    displayLoginForm();


function login() {

   $username = !empty($_POST["username"]) ? trim($_POST["username"]) : null;
   $password = !empty($_POST["password"]) ? trim($_POST["password"]) : null;

   list($pass, $conn) = usernameChecking($username);

    if ($pass) {
        $validPassword = password_verify($password, $pass);
        if($validPassword) {
            disconnect($conn);
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = time();
            header('Location: mysite.php');
            exit;
        }
        else displayLoginForm("Please check your password!");
    }
    else displayLoginForm("Please check your username/password");
}    
function logout() {
    unset($_SESSION['username']);
    unset($_SESSION['logged_in']);
    session_write_close;
    header('Location: login.php');
}  


function displayLoginForm($message = "") {
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
    <h2>Log in to your account</h2>
    <div class="logreg">
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="submit" name="login" value="Login" id="btn">
        </form>
    </div>
    </body>
    </html>
    <?php
}

