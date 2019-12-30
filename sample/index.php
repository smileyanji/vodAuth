<?php
include_once './inc/config.inc' ;
$title = 'Menu - Demo' ;
?>

<?php include_once INC . DIRECTORY_SEPARATOR . 'headers.inc' ; ?>

	<div class="div_head">
		<div>
			<h2>storage</h2>
			<p><a href="./storage/list.php" > - list</a></p>
			<p><a href="./storage/detail.php" > - detail</a></p>
			<p><a href="./storage/total.php" > - total</a></p>
		</div>

		<div>
			<h2>catagory</h2>
			<p><a href="./catagory/create.php" > - Create</a></p>
		</div>

		<div>
			<h2>video</h2>
			<p><a href="./video/upload.php"> - Upload</a></p>
			<p><a href="./video/list.php" > - List</a></p>
		</div>
	</div>
</body>
</html>