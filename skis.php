<?php
  require('controller.php');
  $frm = new Database();
  $count=$frm->count();
  $array=$frm->get_array();
?>



 <!DOCTYPE html>
<html>
<head>
  <title>Inventory</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="styles.css"/>
</head>
<body>
  <div>
  <?php for ($i = 0; $i < $count; $i++){
    $object = $array[$i];
    ?>
    <div style="width:150px; height:300px; float:left;  margin-left: 150px;">
    <img src="image/<?= $object['img'];?>.png" alt="ski"><br>
    <?php echo $object['type']; ?><br>
    <?php echo $object['description']; ?><br>
    <?php echo $object['price']."$"; ?><br>

    </div>
  <?php } 
  ?>

  </body>
</html>