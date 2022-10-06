<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'connection.php';
include_once 'db-functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['getAllClients'])) {
        $vdata = getAllClients($connectDB);
        for ($i=0; $i < count($vdata); $i++) {
            $rdata[] = $vdata[$i];
        }
    }
    echo json_encode($rdata);
    $connectDB->close();
}

?>