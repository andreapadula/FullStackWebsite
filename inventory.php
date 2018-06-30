<?php 
include_once 'config.php';
 
  if($Database->is_loggedin()==false)
{
  $Database->redirect('account.php');
}
if (isset($_POST[('Button')])){
    $Database->redirect('Checkout.php');
}
$email=$Database->getEmail();
?>
<!DOCTYPE html>
<html>
<head>
<title>INVENTORY</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="styles.css"/>
</head>
<body>

Welcome <?= $email?> <a href="logout.php?logout=true"> logout</a><br>
<button onclick="board()" style="margin-left: 50%;" id="Button"> Boards</button>
<button onclick="Skis()" style="margin-left: 50%;" id="Button"> Skis</button>
<div>
	<div id="center" style="width=100%; height:100%;">
		<iframe src="skis.php" style="width:100%; height:600px;" frameborder="0"></iframe>
	</div>
</div>
<form id="rec"  method="post" >
<input type="submit" style="margin-left: 50%;" name ="Button" value="Check Out">
</form>
</body>
</html>
	<script>
var newDiv = document.createElement("IFRAME");
  newDiv.setAttribute("height", "600px");
  newDiv.setAttribute("frameBorder", "0");
  newDiv.setAttribute("width","600%");
  function board()
{
  
  newDiv.setAttribute("src", "board.php");
  document.getElementById("center").innerHTML = "";
  document.getElementById("center").appendChild(newDiv);
  

}

  function Skis()
{
  
  newDiv.setAttribute("src", "skis.php");
  document.getElementById("center").innerHTML = "";
  document.getElementById("center").appendChild(newDiv);
  

}
  </script>