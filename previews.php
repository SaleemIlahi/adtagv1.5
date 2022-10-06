<?php
include "includes/connection.php";
$id=$_GET['id'];
if(isset($_POST['id'])) {
    $id=$_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Previews</title>
  <style>
    #btn {
      margin-left: 25px;
    }
  </style>
</head>

<body>
  <div>
    <?php 
      $sql="SELECT * FROM `adtagdata` WHERE id=$id LIMIT 1";
      $result=mysqli_query($connectDB,$sql);
      $row=mysqli_fetch_assoc($result);
    ?>
    <h2 style="margin-left: 25px;"><?php echo $row['campaign_name']?></h2>
    <br><br>
    <button id="btn" onclick="history.back();">back</button>
  </div>
  <br>
  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Dimension</th>
          <th>Previews</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $dims=$row['dims'];
          $str_arr = explode (",", $dims); 
          $i = 0;
          while($i < count($str_arr)){
            $wh_dim=explode("x",$str_arr[$i])?>
            <tr>   
              <td><?php echo $str_arr[$i]?></td>
              <td>
                <?php if ($row["geo"]==""){ ?>
                 <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i]?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php }
                    else if ($row["geo"]=="true"){ ?>
                    <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=true&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php 
                    }else if ($row["geo"]=="bcamp")
                    { ?>
                      <iframe src='https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $str_arr[$i] ?>&client=<?php echo $row['client']?>&fcat=<?php echo $row['fcat']?>&geo=bcamp&partner=dbm&optout=false&ct0=${CLICK_URL_ENC}&cb=${CACHEBUSTER}&dbmc=${CAMPAIGN_ID}' frameborder='0' scrolling='no' width='<?php echo $wh_dim[0] ?>' height='<?php echo $wh_dim[1] ?>'></iframe>
                    <?php } ?></td>
                </tr><?php
	                $i++;
                }
                ?>  
      </tbody>
    </table>
</body>
</html>