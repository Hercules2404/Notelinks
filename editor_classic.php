<!DOCTYPE html>
<html>
<head>
	<title>ckeditor classic </title>
</head>

<script type="text/javascript">
ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
ClassicEditor.create();
</script>


<body>
	<textarea name="content" id="editor">
	    <p>Here goes the initial content of the editor.</p>
	</textarea>
</body>
</html>