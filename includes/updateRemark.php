<?php 
session_start();
include_once 'connection.php';
include_once 'db-functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $remark = $_POST['remark'];
    $status = $_POST['status_v'];
    $done = updateRemark($connectDB,$id,$remark,$status);
    echo json_encode($done);
}
}

 ?>