<?php
    $servername = 'localhost';
    $username = 'id6033029_hercules';
    $password = 'vuvanduc2013';
    $database = 'id6033029_notelinks_db';
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (isset($_REQUEST["type"])) {
        if (!empty($_REQUEST["type"])) {
            $type       = $_REQUEST["type"];
            $id         = $_REQUEST["id"];
            $title      = $_REQUEST["title"];
            $content    = $_REQUEST["content"];

            if ($type == "edit") {
                $result = edit_post($id, $title, $content);
                echo "$result";
                exit();
            }
        }
    }


    if (isset($_REQUEST["title"])) {
    	if (!empty($_REQUEST["title"])) {
	    	$title = $_REQUEST["title"];
	    	$content = $_REQUEST["content"];
	    	//echo "Add new post: <br>";
	    	//echo "Title: $title <br>";
	    	//echo "Content: $content <br>";
	    	//echo "Result: " . 
			echo add_post($title, $content);
    	} 
    	else {
    		echo "empty post data";
    	}
    	exit();
    }

    if (isset($_REQUEST["delete"])) {
    	if(!empty($_REQUEST["delete"])) {
    		echo delete_post($_REQUEST["delete"]);
    	}
    	else {
    		echo "empty post id";
    	}
    	exit();
    }

    if (isset($_REQUEST["fetch"])) {
    	$fetch = $_REQUEST["fetch"];
    	return_id($fetch);
    	exit();
    }
    


    function random_id() {
    	GLOBAL $connection;
    	while (1) {
	    	$random = mt_rand(10000, 60000);
	    	$sql = "SELECT * FROM `notelinks` WHERE id = $random";
		    $result = mysqli_query($connection, $sql);
            $countrows = mysqli_num_rows($result);
		    if ($countrows == 0) {
		    	return $random;
		    }
    	}
        // Working fine ! :D
    }

    function add_post($title, $content) {
    	$id = random_id();
    	date_default_timezone_set('Asia/Ho_Chi_Minh');
    	$date = date('d/m/Y H:i:s');
    	$sql = "INSERT INTO `notelinks` (`id`, `title`, `content`, `time`) VALUES ('$id', '$title', '$content', '$date')";
    	GLOBAL $connection;
    	$result = mysqli_query($connection, $sql);
    	if ($result != false) {
    		return $id;
    	}

    	return $result;
    }

    function edit_post($id, $title, $content) {
        $sql = "UPDATE `notelinks` SET `title`='$title',`content`='$content' WHERE id='$id' ";
        GLOBAL $connection;
        $result = mysqli_query($connection, $sql);
        if ($result != false) {
            return "true";
        }
        return "false";
    }

    function delete_post($id) {
    	GLOBAL $connection;

/*    	//Checking post
    	$sql = 'SELECT * FROM `notelinks` WHERE id = $id';
		$check = mysqli_query($connection, $sql);
		//echo "check result: '$check'<br>";
		if ($check == false || mysqli_num_rows($check) == 0) {
			return "Can not find post's id !";
		}
*/
		//Delete post
		$sql = "DELETE FROM `notelinks` WHERE id = $id";
    	$result = mysqli_query($connection, $sql);
    	if ($result == false) {
    		return "Post is existing which not deleted.";
    	}

    	//Return result
    	return $result;
    }

    function return_id($id) {
    	if ($id == "all") {
    		$sql = 'SELECT * FROM `notelinks`';
    	}
        if ($id == "lastest") {
            $sql = "SELECT * FROM notelinks ORDER BY time DESC LIMIT 5";
        }
    	else {
    		$sql = "SELECT * FROM `notelinks` WHERE id = $id";
    	}
	    
	    GLOBAL $connection;
	    $result = mysqli_query($connection, $sql);
		$arr = array();
		$count = 0;

		if($result != false) {
		    while ($row = mysqli_fetch_assoc($result)) {
		        $arr[$count] = array('id' => $row['id'], 
								     'title' => $row['title'], 
								     'content' => $row['content'], 
								     'time' => $row['time'] );
		       	$count = $count + 1;
		    }
		}
		else {
			$arr['result'] = 'no thing found !';
		}
	    echo json_encode($arr);
	    mysqli_free_result($result);
	    mysqli_close($connection);
    }


   //INSERT INTO `notelinks` (`id`, `title`, `content`, `time`) VALUES ('1', 'google chrome download', 'this is content google chrome link', '24/05/2018 15:25:21')
   //INSERT INTO `notelinks` (`id`, `title`, `content`, `time`) VALUES ('2', 'firefox download', 'firefox link', '24/05/2018 15:25:21')
?>





