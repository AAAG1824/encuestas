<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
</head>
<body> 
  <form method="post" action="tsta.php" enctype="multipart/form-data" >
  <p><textarea id="summernote1" name="editordata1" rows="5" ></textarea></p>
  <p><textarea id="summernote2" name="editordata2"></textarea></p>
  
   <p><input name="va" type="submit" value="VaTest"></p>
</form> 
  <script>
    $(document).ready(function() {
        $('#summernote1').summernote({
  toolbar: [ 
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
	['view', ['codeview']]
  ]
});
        $('#summernote2').summernote({
  toolbar: [ 
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
	['view', ['codeview']]
  ]
});
    });
  </script>
</body>
</html>