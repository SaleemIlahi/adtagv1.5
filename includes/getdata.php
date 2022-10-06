<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include_once 'connection.php';
include_once 'db-functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rdata = array();
    if (isset($_POST['datefrom']) || isset($_POST['dateto']) || isset($_POST['clients']) || isset($_POST['campaigns'])) {

        $clients = array();
        $campaigns = array();
        $from = $_POST['datefrom'];
        $to = $_POST['dateto'];
        $arr1 = json_decode($_POST['clients']);
        $arr2 = json_decode($_POST['campaigns']);

        foreach($arr1 as $a) {
            $clients[] = $a;
        }
        foreach($arr2 as $a) {
            $campaigns[] = $a;
        }

        /* Get only date records */
        if((count($clients) < 1 && count($campaigns) < 1) && (!empty($from) && !empty($to))) {
            $vdata = getOnlyDateRecords($connectDB,$from,$to);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Get only client records */
        if((count($clients) > 0 && count($campaigns) < 1) && (empty($from) || empty($to))) {
            $vdata = getOnlyClientRecords($connectDB,$clients);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Get only campaign records */
        if(count($campaigns) > 0) {
            $vdata = getOnlyCampaignRecords($connectDB,$campaigns);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Get date and client records */
        if((count($clients) > 0 && count($campaigns) < 1) && (!empty($from) && !empty($to))) {
            $vdata = getDateAndClientRecords($connectDB,$from,$to,$clients);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Show error if fields are empty */
        if((count($clients) < 1 && count($campaigns) < 1) && (empty($from) || empty($to))) {
            $rdata['errors'] = 'Fields empty!';
        }
    } else {
        $rdata['errors'] = 'No data entered!';
    }
    echo json_encode($rdata);
    $connectDB->close();
}

?>