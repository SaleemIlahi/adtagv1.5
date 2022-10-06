<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if(!$_SESSION["username"]){
  header("location: login.php");
}
if($_SESSION["role"] == '2'){
  header("location: client.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Client Campaign Manager</title>
  <?php include "includes/head.php"; ?>
</head>
<body>
  <div class="maincontainer">
    <div class="header">
      <h1>Client Campaign Manager</h1>
    </div>

    

    <div class="inputs">
      <?php 
        if($_SESSION["role"] == 1) {
      ?>
      <form id="form">
      <?php
        } else if($_SESSION["role"] == 0) {
      ?>
      <form id="form2">
      <?php
        }else if($_SESSION["role"] == 3){
      ?>
      <form id="form4">
      <?php
        }
      ?>
        <div class="input-box">
          <label for="datefrom">From</label>
          <input type="date" name="datefrom" id="datefrom">
        </div>

        <div class="input-box">
          <label for="dateto">To</label>
          <input type="date" name="dateto" id="dateto">
        </div>

        <div class="input-box">
          <label for="clients">Clients</label>
          <select id="clients" multiple="multiple">
          </select>
        </div>

        <div class="input-box">
          <label for="campaigns">Campaigns</label>
          <select id="campaigns" multiple="multiple">
          </select>
        </div>

        <div class="input-box">
          <button name="submit">Show adtags</button>
        </div>

        <div class="btn-gp">
          <?php 
            if($_SESSION["role"] == 0){
          ?>
          <button><a href="console.php">console</a></button>
          <?php } ?>
          <button><a href="logout.php">logout</a></button>
        </div>
      </form>
    </div>

    <div id="table" class="table">
    </div>

  </div>
  <script type="text/javascript">
    let team = '<?php echo $_SESSION["team"] ?>'
  </script>
</body>
</html>