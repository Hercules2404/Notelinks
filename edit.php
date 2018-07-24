<?php
    $servername = 'localhost';
    $username = 'id6033029_hercules';
    $password = 'vuvanduc2013';
    $database = 'id6033029_notelinks_db';
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (isset($_REQUEST["id"])) {
    	if (!empty($_REQUEST["id"])) {
	    	$id = $_REQUEST["id"];

	    	$sql = "SELECT * FROM `notelinks` WHERE id = $id";
		    $result = mysqli_query($connection, $sql);
            $countrows = mysqli_num_rows($result);

            if ($countrows > 0) {
            	$row = mysqli_fetch_assoc($result);
            	$title = $row['title'];
            	$content = $row['content'];
            }
            else {
            	echo "can not find database of post id $id";
            	exit();
            }

    	} 
    	else {
    		echo "Wrong request parameters! Please make sure that you enter correct id of post.";
    		exit();
    	}
    }
    else {
	    include 'postnotfound.php';
	    exit();
    }


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document editor</title>
	<link rel="stylesheet" type="text/css" href="./sources/notelinks_content.css" />
	<link rel="stylesheet" type="text/css" href="./sources/main.css" />
	<link rel="stylesheet" type="text/css" href="./sources/controlpanel.css" />
	<link rel="stylesheet" type="text/css" href="./sources/ckeditor.css" />

    <script src="./sources/ckeditor.js"></script>
    <script type="text/javascript" src="./sources/jquery.min.js"></script>
</head>

<style type="text/css">
	body {
		padding: 20px 70px;
		background-color: #FFF;
	}
</style>
<body>
    <h1 style="font-size: 30px; font-weight: 600px; color: #444">Notelinks Editor - post <?php echo $id;?></h1>

	<div class="content" style="border:1px solid grey; border-radius: 10px; padding: 30px 20px;">
		<input type="text" name="post_title" id="post_title" placeholder="Which is title of your post?" value="<?php echo $title; ?>"></input>
		<!--textarea id="post_content" placeholder="Enter your content of post here..." style="width: 100%; height: 200px; padding: 12px 20px; margin: 8px 0px; display: block; border: 1px solid #ccc; box-sizing: border-box; font-size: 14px; color: #333333; font-family: 'Segoe UI'; "></textarea-->

	    <!-- The toolbar will be rendered in this container. -->
	    <div id="toolbar-container"></div>
	    <style type="text/css">
	    	#editor {
	    		height: 550px; 
	    		//border: 1px solid grey;
	    		background-color: #FFF;
	    		font-size: 18px;
	    		margin-top: 0px!important;
	    	}

	    	#editor:active {
	    		//border: 1px solid green;
	    		box-shadow: 0px 0px 10px #ccc;
	    	}

	    </style>
	    <!-- This container will become the editable. -->
	    <div style="border: 1px solid #c4c4c4;">
		    <div id="editor" class="content-post">
		        <?php echo $content; ?>
		    </div>
		</div>
		<button id="button_post" style="margin-top: 10px;">SAVE CHANGE</button>
	</div>
	<div style="font-size: 14px; font-family: 'segoe ui'; color: #555; margin-top: 100px; text-align: center;">Copyright @2018. All rights is reservered.</div>
</body>
</html>

<script type="text/javascript">
	$('#button_post').on('click', function client_post() {
		var title = $('#post_title').val();
		if (title == "") {
			alert("Please enter tittle of your post.");
			return ;
		}
		var content = getcontent();
		console.log("saving change...");
		$.ajax({
			url 	: 'manage.php',
			method 	: 'POST',
			data	: {
				type	: 'edit',
				id 		: '<?php echo $id; ?>',
				title 	: title,
				content : content
			},
			success : function(response) {
				console.log("save post result:" + response);
				location.href = "./viewpost.php?id=<?php echo $id; ?>";
			},
			failed : function(response) {
				console.log("save post failed: " + response);
			}
		});

	});
</script>

<script type="text/javascript">
	var ObjEditor
    DecoupledEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            const toolbarContainer = document.querySelector( '#toolbar-container' );
            toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            ObjEditor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
    function getcontent() {
		var data = ObjEditor.getData();
		//document.getElementById("post-content").innerHTML = data;
		return data;
    }

</script>

