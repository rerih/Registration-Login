<?php

require_once('config.php');
/*
***Connecting with DB 
*/
function connect() {
    try {
        $conn = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e) {
        echo "Connection to the " . DB_DNS . " failed " . $e->getMessage();
    }  
}
/*
*
*/
function disconnect($conn) {
    $conn = "";
}

/*
***This function returns array($password, $conn)
*/
function usernameChecking($username) {
  
    $conn = connect(); //DB Connection

    $sql = "SELECT id, username, password FROM users where username = :username";
    try {
        $st = $conn->prepare($sql);
        $st ->bindValue(":username", $username, PDO::PARAM_STR);  
        $st->execute();
        $result = $st->fetch(PDO::FETCH_ASSOC);

       return array($result['password'], $conn);
    } 
    catch(PDOException $e) {
        echo "Query failed " . $ $e->getMessage();
    }
}

function createNewAccount($conn, $username, $passHash) {
    $sql = 'INSERT INTO users (username, password) VALUES (:username, :password)';
    try {
        $st = $conn->prepare($sql);
        $st->bindvalue(":username", $username, PDO::PARAM_STR);
        $st->bindvalue(":password", $passHash, PDO::PARAM_STR);
        $st->execute();    

    } catch(PDOException $e) {
        die("Can't inser data into users table") . $e->getMessage();
    }
}