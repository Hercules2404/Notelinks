<?php
    $servername = 'localhost';
    $username = 'id6033029_hercules';
    $password = 'vuvanduc2013';
    $database = 'id6033029_notelinks_db';
    $connection = mysqli_connect($servername, $username, $password, $database);


    if (isset($_REQUEST["id"])) {
    	if (!empty($_REQUEST["id"])) {
	    	$id = $_REQUEST["id"];
	    	$data = get_post_content($id);
	    	if ($data == "") {
	    		include "./postnotfound.php";
	    		exit();
	    	}
	    	include "./postcontent.php";
	    	exit();
    	} 
    	else {
	    		include "./postnotfound.php";
	    		exit();
    	}
    	exit();
    }

    echo "wrong request post's id!";


    function get_post_content($id) {
    	$sql = "SELECT * FROM `notelinks` WHERE id = $id";
	    GLOBAL $connection;
	    $result = mysqli_query($connection, $sql);
		$arr = array();
		$count = 0;

		if($result != false) {
		    while ($row = mysqli_fetch_assoc($result)) {
		        $arr = array('id' => $row['id'], 
						     'title' => $row['title'], 
						     'content' => $row['content'], 
						     'time' => $row['time'] );
		       	$count = $count + 1;
		    }
		    if ($count > 0) {
		    	//echo json_encode($arr);
		    	return $arr;
		    }
		}
	    
	    mysqli_free_result($result);
	    mysqli_close($connection);
	    return "";
    }
?>