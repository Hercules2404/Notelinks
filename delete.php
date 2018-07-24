<?php
    $servername = 'localhost';
    $username = 'id6033029_hercules';
    $password = 'vuvanduc2013';
    $database = 'id6033029_notelinks_db';
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (isset($_REQUEST["id"])) {
    	if (!empty($_REQUEST["id"])) {
	    	$id = $_REQUEST["id"];
	    	if ($id == "") {
	    		include "./postnotfound.php";
	    		exit();
	    	}
	    	$sql = "DELETE FROM `notelinks` WHERE id = '$id'";
	    	$result = mysqli_query($connection, $sql);
    	} 
    	else {
    		include "./postnotfound.php";
    		exit();
    	}
    }
    else {
    		include "./postnotfound.php";
    		exit();
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Notelinks 2018</title>
	<link rel="stylesheet" type="text/css" href="./sources/notelinks_content.css" />
	<link rel="stylesheet" type="text/css" href="./sources/main.css" />
	<link rel="stylesheet" type="text/css" href="./sources/button.css" />

	<script type="text/javascript" src="./sources/jquery.min.js"></script>
	<link rel="shortcut icon" href="./sources/webicon.ico" type="image/x-icon">
</head>

<body>
	<div style="background-color: #34bb7d; overflow: auto; padding: 10px 40px; vertical-align: baseline;">
		<a href="./"><img src="./sources/main.png" style="float: left; margin-left: 30px; width: 60px; height: 60px;"></a>
		<div style="float: right; color: #FFFFFF; font-family: 'segoe ui'!important; line-height: 60px; letter-spacing: 3px;">WELCOME TO NOTELINKS WEBSITE </div>
	</div>
	<div style="padding: 30px 120px;">
		<div style="font-size: 28px; font-weight: 600; margin-top: 50px;">DELETE POST #<?php echo $id;?></div>
		<div style="font-size: 20px; margin-top: 20px; border-radius: 5px; border: 1px solid #aaaaaa; padding: 9px 16px; background-color: #EEEEEE; color: #3a3a3a;">
			<?php 
				if ($result == true) {
					echo "Post is completely deleted successfully. ";
				}
				else {
					echo "Can not delete post #$id";
				}
			?>
		 	<br> <br> Click in button below to go to homepage.</div>
		<div style="margin-top: 30px;"></div>
		<button class="button" id="button_back" style="float: right;">Go to Homepage</button>
	</div>


	
	<div style="background-color: #34bb7d; overflow: auto; vertical-align: middle; margin-top: 100px; padding: 50px 50px;">
		<div style="width: 50%; float: left;">
			<div style="color: #FFFFFF; letter-spacing: 1px; margin-left: 20px;">NOTELINKS SERVER</div>
			<div style="margin: 10px 20px; font-size: 18px;">
				<div style="color: #EEEEEE; text-indent: 50px; text-align: justify;">This website is deloyed in June 2018. It is designed for studying and researching purposes. Some features in this site may be needed for someone who need digital notes. All users used this page can send feedback about this website to author to continue developing it. Greatest thanks!</div>
			</div>
		</div>

		<div style="width: 50%; float:  right;">
			<div style="color: #FFFFFF; letter-spacing: 1px; margin-left: 20px;">CONTACT INFORMATION</div>
			<div style="margin: 10px 20px; font-size: 18px;">
				<div style="color: #EEEEEE;">All feedback will be reply as soon as possible.</div>
				<div style="color: #EEEEEE; display: list-item; margin-left: 30px;">Email: <a href="mailto:ducduc08@gmail.com" style="color: #EEEEEE;">Gmail Account</a></div>
				<div style="color: #EEEEEE; display: list-item; margin-left: 30px;">Github: <a href="https://github.com/hercules2404" style="color: #EEEEEE;">Hercules2404</a></div>
			</div>
		</div>
	</div>
</body>

<script type="text/javascript">
	document.getElementById('button_back').onclick = function() {
		location.href = '../';
	}
</script>
