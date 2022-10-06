<?php

include_once "dbconfig.php";

// $errors = array();
// $response = array();

// try {
//   $connectDB = new PDO($dbsn, $dbusername, $dbpassword);
//   $connectDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   // $connectDB->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));
// } catch (PDOException $exception) {
//   echo "Connection failed: " . $exception->getMessage();
// }

$connectDB = mysqli_connect($servername,$username,$password,$dbname);
if (!$connectDB){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

?>