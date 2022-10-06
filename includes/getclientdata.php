<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include_once 'connection.php';
include_once 'db-functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rdata = array();
    $team = $_SESSION['team'];
    if (isset($_POST['datefrom']) || isset($_POST['dateto']) || isset($_POST['campaigns'])) {

        $campaigns = array();
        $from = $_POST['datefrom'];
        $to = $_POST['dateto'];
        $arr1 = json_decode($_POST['campaigns']);

        foreach($arr1 as $a) {
            $campaigns[] = $a;
        }

        /* Get date records for the client page*/
        if(!empty($team) && (!empty($from) && !empty($to)) && count($campaigns) < 1) {
            $vdata = getActiveRecordsWithDate($connectDB,$from,$to,$team);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Get client records for the client page*/
        else if(!empty($team) && (empty($from) || empty($to)) && count($campaigns) > 0) {
            $vdata = getActiveRecordsWithClient($connectDB,$team,$campaigns);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Get campaign records for the client page*/
        else if(!empty($team) && count($campaigns) > 0) {
            $vdata = getActiveRecordsWithClient($connectDB,$team,$campaigns);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Show error if fields are empty */
        else if(count($campaigns) < 1 && (empty($from) || empty($to))) {
            $rdata['errors'] = 'Fields empty!';
        }
    } else {
        $rdata['errors'] = 'No data entered!';
    }
    echo json_encode($rdata);
    $connectDB->close();
}

?>