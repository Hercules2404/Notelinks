<!DOCTYPE html>
<html>
<head>
	<title>Notelinks 2018</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="./sources/webicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="./sources/notelinks_content.css" />
	<link rel="stylesheet" type="text/css" href="./sources/main.css" />
	<link rel="stylesheet" type="text/css" href="./sources/ckeditor.css" />

	<script type="text/javascript" src="./sources/jquery.min.js"></script>
	
</head>

<style type="text/css">
	.link {
		display: inline-block;
		font-size: 16px;
	}
	.link a {
		color: #0175bb;
		text-decoration: none;
	}

	.link a:hover {
		text-decoration: underline;
	}

	#gotop {
	  display: none;
	  position: fixed;
	  bottom: 20px;
	  right: 30px;
	  z-index: 99;
	  font-size: 16px;
	  outline: none;
	  background-color: #00af5f;
	  color: white;
	  cursor: pointer;
	  padding: 0px 15px;
	  border-radius: 4px;
	  border: 1px solid #00af5f;
	  box-shadow:0px 0px 50px grey; 
	}

	#gotop:hover {
	  border: 1px solid #3583b5;
	  box-shadow:0px 0px 50px #3583b5; 
	  background-color: #049e58;
	}
</style>

<style type="text/css">
.post-button {
	background-color: #eee;
	border: 1px solid #999;
	cursor: pointer;
	display: inline-block;
	border-radius: 7px;
	
	padding: 0px 10px;
	padding-bottom: 2px;
}

.post-button:hover {
	background-color: #b5dafb;
	border: 1px solid #43b0ff;
	box-shadow: 2px 5px 5px #ccc;
}

.post-button img {
	vertical-align: bottom;
	display: inline-block;
}

.post-button a {
	padding-top: 10px;
	color: #222;
	text-decoration: none;
	font-size: 14px;
	font-family: "Segoe UI";
}

</style>


<body style="background-color: #f2f2f2;">
	<?php include 'header.php'; ?>

	<div style="padding: 30px 30px;">
		<div style="margin-bottom: 20px;" class="link">
			<a class="link" href="../">HOMEPAGE</a>
			<div class="link" style="margin: 0px 10px;">●</div>
			<div class="link">VIEW POST</div>
		</div>
		<div class="content" style="background-color: #FFFFFF!important; font-family: Helvetica,Arial,sans-serif!important; padding: 50px!important; border-radius: 10px;">
			<div style="font-size: 30px; font-weight: 600;"><?php echo $data['title']; ?></div>
			<div style="display: inline-block;">
				<button class="post-button">
					<a href="./edit.php?id=<?php echo $data['id']; ?>"><img src="./sources/edit.png" width="20px" height="20px" style="margin-right: 5px;">Edit</a> 
				</button>

				<button class="post-button">
					<a href="./delete.php?id=<?php echo $data['id']; ?>"><img src="./sources/delete.png" width="20px" height="20px"> Delete</a>
				</button>
			</div>

			<div style="font-size: 14px; color: #555; display: inline-block; ">#<?php echo $data['id']; ?> - posted at <?php echo $data['time']; ?> (GMT+7)</div>
			<div style="padding-bottom: 10px; border-bottom: 1px solid grey; color: #555; display: block;"></div>
			<div class="content-post"><?php echo $data['content']; ?></div>

			<?php include "lastedpost.php";?>
		</div>
	</div>

	<button style="float: right; font-family: Segoe UI; font-weight: 800; font-size: 30px;" id="gotop">↑</button>

	<?php include 'footer.php'; ?>

</body>


<script type="text/javascript">
	$("#gotop").on('click', function() {
		$('html, body').animate({scrollTop:0}, 'slow');
	});

	window.onscroll = function() {scrollFunction()};
	function scrollFunction() {
	    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
	        document.getElementById("gotop").style.display = "block";
	    } else {
	        document.getElementById("gotop").style.display = "none";
	    }
	   
	}
</script>