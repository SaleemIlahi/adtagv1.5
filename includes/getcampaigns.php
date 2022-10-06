<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include_once 'connection.php';
include_once 'db-functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rdata = array();
    $team = $_SESSION['team'];
    
    if (isset($_POST['datefrom']) || isset($_POST['dateto']) || isset($_POST['clients'])) {

        $clients = array();
        $from = $_POST['datefrom'];
        $to = $_POST['dateto'];
        $arr1 = json_decode($_POST['clients']);
        foreach($arr1 as $a) {
            $clients[] = $a;
        }

        /* Get all campaigns with date */
        if((!empty($from) && !empty($to)) && (count($clients) < 1)) {
            $vdata = getCampaignsWithDate($connectDB,$from,$to);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Get all campaigns with client */
        else if((count($clients) > 0) && (empty($from) || empty($to))) {
            $vdata = getCampaignsWithClient($connectDB,$clients);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Get all campaigns with date and client */
        else if((!empty($from) && !empty($to)) && (count($clients) > 0)) {
            $vdata = getCampaignsWithDateAndClient($connectDB,$from,$to,$clients);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Get all campaigns with date and client and empty */
        else if((empty($from) || empty($to)) && (count($clients) < 1)) {
            $vdata = getAllCampaigns($connectDB);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /************************************
        Conditions for client.php begin here
        ************************************/

        /* Get all campaigns with date and client for client.php */
        else if((!empty($from) && !empty($to)) && !empty($team) && count($clients) < 1) {
            $vdata = getActiveCampaignsWithClientAndDate($connectDB,$from,$to,$team);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }

        /* Get all campaigns with client for client.php */
        else if(!empty($team) && (empty($from) || empty($to)) && count($clients) < 1) {
            $vdata = getAllActiveCampaignsWithClient($connectDB,$team);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }
    }

    else if(isset($_POST['getAllCampaigns'])) {
        if(!empty($team) && $_SESSION['role'] > 2){
            $vdata = getAllCampaigns($connectDB);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }else if(!empty($team) && $_SESSION['role'] > 1) {
            $vdata = getAllActiveCampaignsWithClient($connectDB,$team);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        } else {
            $vdata = getAllCampaigns($connectDB);
            for ($i=0; $i < count($vdata); $i++) {
                $rdata[] = $vdata[$i];
            }
        }
    }
    echo json_encode($rdata);
    $connectDB->close();
}

?>