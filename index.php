<!-- Duncan Keller -->
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"> -->
<LINK href="style.css" rel="stylesheet" type="text/css">

<html>
	<head>
		<title>DRINK LOTTO</title>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="drinkLotto.js"></script>
	<head>
	<body>
	
		<?php
			error_reporting(E_ALL);
			require("webauth_vars.php");
			$info = getInfo(); 
			$name = $info[0]['uid'][0];
			$credits = $info[0]['drinkbalance'][0];
			
			
		?>
		<img id = "back" src = "Images/background.png" />
		
		<a href="#" onclick= "reset()" ><img id = "button" src="Images/lever1.png" alt="javascript button"></a>
			
		
		
		<img id = "slot1" src = "Images/blankSlot.png" />
		<img id = "slot2" src = "Images/blankSlot.png" />
		<img id = "slot3" src = "Images/blankSlot.png" />
		
		<img id = "0" src = "Images/slot0.png" />
		<img id = "1" src = "Images/slot1.png" />
		<img id = "2" src = "Images/slot2.png" />
		<img id = "3" src = "Images/slot3.png" />
		<img id = "4" src = "Images/slot4.png" />
		<img id = "5" src = "Images/slot5.png" />
		<img id = "6" src = "Images/slot6.png" />
		<img id = "lever1" src = "Images/lever1.png" />
		<img id = "lever2" src = "Images/lever2.png" />
		
		<div id = "header">Drink Lotto</div>
		
		
		
		<div id="name" class = "userInfo" >User: <?= $name ?></div>
		
		<div id="credits" class = "userInfo" id = "credits">Credits: <?= $credits; ?></div>		
		
		<div id = "win">WINNER!</div>
		
		
		
		
		
		
		<?php
			
		?>
	</body>
</html>