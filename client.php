<?php  

session_start();
if(!$_SESSION["username"]){
  header("location: login.php");
}
// echo $_SESSION["team"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>HC Adtag Console</title>
  <?php include "includes/head.php"; ?>
</head>
<body>
  <div class="maincontainer">
    <div class="header">
      <h1>HC Ad Tag Console</h1>
    </div>

    <div class="inputs">
      <form id="form3">
        <div class="input-box">
          <label for="datefrom">From</label>
          <input type="date" name="datefrom" id="datefrom">
        </div>

        <div class="input-box">
          <label for="dateto">To</label>
          <input type="date" name="dateto" id="dateto">
        </div>

        <div class="input-box">
          <label for="campaigns">Campaigns</label>
          <select id="campaigns" multiple="multiple">
          </select>
        </div>

        <div class="input-box">
          <button name="submit">Show adtags</button>
        </div>

        <div class="input-box">
          <button><a href="logout.php">log out</a></button>
        </div>
      </form>
    </div>

    <div id="table" class="table">
    </div>


  </div>
</body>
</html>