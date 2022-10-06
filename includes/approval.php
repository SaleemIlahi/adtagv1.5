<?php 
session_start();
include_once 'connection.php';
include_once 'db-functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $done = updateApprovalStatus($connectDB,$id,true,$_SESSION["username"]);
    echo json_encode($done);
}
}

 ?>