<!DOCTYPE html>

<html>
<head>
	<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
	<title>Title goes here</title>
</head>

<body>



<?php include 'postsShow.php'; ?>



<!-- Type for input can be password, text, or submit -->




<div id="forms">
	<form method="post" action="postsForm.php">
	Post content: <input name="pContent" type="text" /><br>
	<input name="submit" type="submit" />
	</form>
</div>




</body>

</html>
