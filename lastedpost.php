<!DOCTYPE html>
<html>
<head>
	<title>lastest post</title>
</head>
<style type="text/css">
.lastestpost {
	line-height: 1.5;
	font-family: "segoe ui";
}

.lastestpost #title {
	font-size: 24px;
	color: #555;
	line-height: 1.5;
	font-weight: 600;
}

.lastestpost ul {
	margin: 0px;
}

.lastestpost li {
	font-size: 18px;
	font-style: italic;
	color: #555;
}
</style>
<body>
	<div class="lastestpost">
		<div id="title">Recently Post</div>
		<ul>
			<?php
			    $servername = 'localhost';
			    $username = 'id6033029_hercules';
			    $password = 'vuvanduc2013';
			    $database = 'id6033029_notelinks_db';
			    $connection = mysqli_connect($servername, $username, $password, $database);

			    $sql = "SELECT * FROM notelinks ORDER BY time DESC LIMIT 5";
			    $result = mysqli_query($connection, $sql);

				if($result != false) {
				    while ($row = mysqli_fetch_assoc($result)) {
						echo '<li><a href="/viewpost.php?id=' .  $row['id'] . '">' . $row['title'] . '</a></li>';
				    }
				}
				else {
					$arr['result'] = 'no thing found !';
				}
			    mysqli_free_result($result);
			    mysqli_close($connection);
			?>

		</ul>
	</div>

</body>
</html>