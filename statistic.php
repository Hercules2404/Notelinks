<?php
    $servername = 'localhost';
    $username = 'id6033029_hercules';
    $password = 'vuvanduc2013';
    $database = 'id6033029_notelinks_db';
    $connection = mysqli_connect($servername, $username, $password, $database);

    $sql = "SELECT * FROM `statistic` WHERE  1";
    $result = mysqli_query($connection, $sql);
    $totalvisitor = 0;
    $totalpost = 0;
	if(mysqli_num_rows($result) > 0) {
		//echo "result count " . mysqli_num_rows($result). "<br>";
	    while ($row = mysqli_fetch_assoc($result)) {
	    	$data = $row['data'];
	    	switch ($row['type']) {
	    		case 'totalpost':
	    			//echo "totalpost = $data <br>";
	    			$totalpost = $data;
	    			break;
	    		case 'totalvisitor':
	    			//echo "totalvisitor = $data";
	    			$totalvisitor = $data;
	    			break;
	    	}
	    }
		//$data = json_encode($arr);
		//echo "Result is : $data";
	    $totalvisitor += 1;
	    $sql = "UPDATE `statistic` SET `data`= $totalvisitor WHERE type = 'totalvisitor'";
	    mysqli_query($connection, $sql);
	}
	else {
		echo "can not query totalvisitor from database";
	}

	/*User IP Address*/
	$client_ip_address = getenv('HTTP_CLIENT_IP')?:
	getenv('HTTP_X_FORWARDED_FOR')?:
	getenv('HTTP_X_FORWARDED')?:
	getenv('HTTP_FORWARDED_FOR')?:
	getenv('HTTP_FORWARDED')?:
	getenv('REMOTE_ADDR');


	/*User Visited*/
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$date = date('d/m/Y H:i:s');
	$sql = "INSERT INTO `ipstatistic` (`ipaddress`, `visited`, `time`) VALUES ('$client_ip_address', '1', '$date')";
	mysqli_query($connection, $sql);
    $sql = "SELECT * FROM `ipstatistic` WHERE ipaddress='$client_ip_address'";
    $result = mysqli_query($connection, $sql);
    $uservisited = mysqli_num_rows($result);
	if(mysqli_num_rows($result) > 0) {
		//echo ; ????
	}

	/*Total Post*/
    $sql = "SELECT id FROM `notelinks` WHERE 1";
    $result = mysqli_query($connection, $sql);
    $totalpost = mysqli_num_rows($result);



   	mysqli_free_result($result);
	mysqli_close($connection);
?>