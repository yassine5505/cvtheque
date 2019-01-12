<?php
$servername = "sql305.epizy.com";
$username = "epiz_23280423";
$password = "9pk8YdSTsPDw";

try {
    $conn = new PDO("mysql:host=$servername;dbname=epiz_23280423_cvtheque", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Base de données connectée !";
}
catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
}
?>
