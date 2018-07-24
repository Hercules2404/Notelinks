<!DOCTYPE html>
<html>
<head>
	<title>Notelinks 2018</title>
	<link rel="shortcut icon" href="./sources/webicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="./sources/notelinks_content.css" />
	<link rel="stylesheet" type="text/css" href="./sources/main.css" />
	<link rel="stylesheet" type="text/css" href="./sources/controlpanel.css" />
	<link rel="stylesheet" type="text/css" href="./sources/ckeditor.css" />

	<script type="text/javascript" src="./sources/jquery.min.js"></script>
	<script src="./sources/ckeditor.js"></script>
</head>

<body style="font-family: 'segoe ui', 'tahoma';">
	<?php
		include "header.php";
	?>

	<div style="padding: 30px 30px; background: #FFF;">
		<div style="text-align: center; margin-top:10px; margin-bottom: 50px; font-size: 28px; border-bottom: 1px solid #548342;">Notelinks Website Statistics</div>
		<div class="controlpanel">
			<img src="./sources/statistic.png" style="width: 80px; height: 80px; vertical-align: middle;">
			<div style="display: inline-table;">
				<div style="font-size: 30px; font-weight: 500; color: #0175bb;"><?php 
						include "statistic.php";
						echo "$totalpost";
					?></div>
				<div style="font-style: 18px;">Total Posts</div>
			</div>
		</div>
		<div class="controlpanel">
			<img src="./sources/totalvisited.png" style="width: 80px; height: 80px; vertical-align: middle;">
			<div style="display: inline-table;">
				<div style="font-size: 30px; font-weight: 500; color: #00c02d;"><?php 
						echo $totalvisitor;
					?></div>
				<div style="font-style: 18px;">Total Visitors</div>
			</div>
		</div>
		<div class="controlpanel" style="width: 300px!important;">
			<img src="./sources/userip.png" style="width: 80px; height: 80px; vertical-align: middle;">
			<div style="display: inline-table;">
				<div style="font-size: 30px; font-weight: 500; color: #db9200;"><?php
						echo $client_ip_address;
					?></div>
				<div style="font-style: 18px;">Your IP Address</div>
			</div>
		</div>
		<div class="controlpanel">
			<img src="./sources/uservisited.png" style="width: 80px; height: 80px; vertical-align: middle;">
			<div style="display: inline-table;">
				<div style="font-size: 30px; font-weight: 500; color: #d20199;"><?php 
					echo $uservisited;
				?></div>
				<div style="font-style: 18px;">Your Visited</div>
			</div>
		</div>

		<div style="text-align: center; margin-top:10px; margin-bottom: 50px; font-size: 28px; border-bottom: 1px solid #548342;">Post New Notelinks</div>
		<div class="topic">
			<div class="title">New Notelinks...</div>
			<div class="content">
				<input type="text" name="post_title" id="post_title" placeholder="Which is title of your post?">
				<!--textarea id="post_content" placeholder="Enter your content of post here..." style="width: 100%; height: 200px; padding: 12px 20px; margin: 8px 0px; display: block; border: 1px solid #ccc; box-sizing: border-box; font-size: 14px; color: #333333; font-family: 'Segoe UI'; "></textarea-->

			    <!-- The toolbar will be rendered in this container. -->
			    <div id="toolbar-container"></div>
			    <style type="text/css">
			    	#editor {
			    		height: 500px; 
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
				        <p>This is the initial editor content.</p>
				    </div>
				</div>
				<button id="button_post" style="margin-top: 10px;">POST NEW TOPIC</button>
			</div>
		</div>


		<div style="text-align: center; margin-top:10px; margin-bottom: 50px; font-size: 28px; border-bottom: 1px solid #548342;">Lastest Notelinks Post</div>
		<div id="post" style="padding: 0px 50px;">
			<!--div class="content showdata">
				<div id="post_title"><a href="./viewpost.php?id=25643">Google Chrome Download</a></div>
				<div id="post_id">Post ID: 25643</div>
				<div id="post_time"> - Time: 02/06/2018 09:52:28</div>
				<div id="post_content">google download link https://sfdasdfs.com/ss.exe</div>
			</div>
			<div class="content showdata">
				<div id="post_title"><a href="./viewpost.php?id=25643">Google Chrome Download</a></div>
				<div id="post_id">Post ID: 25643</div>
				<div id="post_time"> - Time: 02/06/2018 09:52:28</div>
				<div id="post_content">google download link https://sfdasdfs.com/ss.exe</div>
			</div-->
		</div>

		<style type="text/css">
			a.showdata {
				text-decoration: unset;
				color: #20b2aa;
			}

			a.showdata:hover {
				cursor: pointer;
				text-decoration: underline;
				color: #20b2aaaa;
				transition: 0.5s;
			}
		</style>

	</div>

	<?php 
		include 'footer.php';
	?>

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
		console.log("uploading your new post...");
		$.ajax({
			url 	: 'manage.php',
			method 	: 'POST',
			data	: {
				title 	: title,
				content : content
			},
			success : function(response) {
				console.log("post-id:" + response);
				location.reload();
			},
			failed : function(response) {
				console.log("post failed: " + response);
			}
		});

	});

	function create_post(id, title, content, time) {

		if (content.length > 75) {
			content = content.substring(0, 75) + "...";
		}

		var data = '<div class="content showdata">';
			data+= '<div id="post_title"><a class="showdata" href="./viewpost.php?id=' + id + '">' + title + '</a></div>';
			data+= '<div id="post_id">Post ID: ' + id + '</div>';
			data+= '<div id="post_time"> - Time: ' + time + '</div>';
			data+= '<div id="post_content">' + content + '</div>';
			data+= '</div>';
		return data
	}

	$(document).ready(function load_database() {
		$.ajax({
			url 	: 'manage.php',
			method 	: 'POST',
			data	: {
				fetch : 'lastest'
			},
			success : function(response) {
				console.log("load database:" + response);

				var json = JSON.parse(response);
		        for(var i = 0; i < json.length; i++) {
		        	var previous = $('#post').val();
		        	var post = create_post(json[i].id, json[i].title, json[i].content, json[i].time);
		        	$('#post').append(post);
		        }
			},
			failed : function(response) {
				console.log("load failed: " + response);
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