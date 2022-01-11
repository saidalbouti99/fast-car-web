<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include_once 'database.php';
 
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>