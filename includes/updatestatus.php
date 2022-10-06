<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'connection.php';
include_once 'db-functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rdata = array();
    if (isset($_POST['id']) || isset($_POST['status']) || isset($_POST['datefrom']) || isset($_POST['dateto']) || isset($_POST['clients']) || isset($_POST['campaigns'])) {

        $clients = array();
        $campaigns = array();
        $id = $_POST['id'];
        $status = $_POST['status'];
        $from = $_POST['datefrom'];
        $to = $_POST['dateto'];
        $arr1 = json_decode($_POST['clients']);
        $arr2 = json_decode($_POST['campaigns']);
        // $active_time =$_POST['active_time'];
        foreach($arr1 as $a) {
            $clients[] = $a;
        }
        foreach($arr2 as $a) {
            $campaigns[] = $a;
        }

        if(!empty($id) && !empty($status)) {
            $isDone = updateStatus($connectDB,$id,$status,$_SESSION["username"]);
            if($isDone) {
                /* Get only date records */
                if((count($clients) < 1 && count($campaigns) < 1) && (!empty($from) && !empty($to))) {
                    $vdata = getOnlyDateRecords($connectDB,$from,$to);
                    for ($i=0; $i < count($vdata); $i++) {
                        $rdata[] = $vdata[$i];
                    }
                }

                /* Get only client records */
                else if((count($clients) > 0 && count($campaigns) < 1) && (empty($from) || empty($to))) {
                    $vdata = getOnlyClientRecords($connectDB,$clients);
                    for ($i=0; $i < count($vdata); $i++) {
                        $rdata[] = $vdata[$i];
                    }
                }

                /* Get only campaign records */
                else if(count($campaigns) > 0) {
                    $vdata = getOnlyCampaignRecords($connectDB,$campaigns);
                    for ($i=0; $i < count($vdata); $i++) {
                        $rdata[] = $vdata[$i];
                    }
                }

                /* Get date and client records */
                else if((count($clients) > 0 && count($campaigns) < 1) && (!empty($from) && !empty($to))) {
                    $vdata = getDateAndClientRecords($connectDB,$from,$to,$clients);
                    for ($i=0; $i < count($vdata); $i++) {
                        $rdata[] = $vdata[$i];
                    }
                }
            }
        }
    } else {
        $rdata['errors'] = 'No data entered!';
    }
    echo json_encode($rdata);
    $connectDB->close();
}

?>