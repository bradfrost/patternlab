<?php include_once('functions.php'); ?><!DOCTYPE html>
<html>
<head>
    <title>Style Guide</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="<?php echo $absolutePath; ?>styleguide/css/styleguide.css" media="all" />
    <link rel="stylesheet" href="<?php echo $absolutePath; ?>css/style.css" media="all" />
    <script src="<?php echo $absolutePath; ?>js/modernizr.js"></script>
</head>
<body>
	<?php
		$url = $_GET["url"];
		include	$patternsPath.$url;
	?>
</body>
</html>