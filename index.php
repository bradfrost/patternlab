<?php include_once('functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Pattern Library</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="styleguide/css/styleguide.css" media="all" />
    
    <!--For style guide only. Move all scripts to bottom for production-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="styleguide/js/jquery.js"><\/script>')</script>
	<!--For style guide only. Move all scripts to bottom for production-->
</head>
<body>
<!--Style Guide Header-->
<header class="sg-header" role="banner">
	<a href="#sg-nav-container" class="sg-nav-toggle">Menu</a>
	<div class="sg-nav-container" id="sg-nav-container">
		<?php include('styleguide/includes/nav.php'); ?>
		<?php include('styleguide/includes/controls.php'); ?>
	</div>
</header>
<!--End Style Guide Header-->

<!-- Iframe -->
<?php
	$url = $_GET["url"];
	
	if($url) {
		$path = "view.php/?url=".$url;
	} else {
		$path = "styleguide.php";
	}
?>

<!-- Iframe -->
<div id="sg-vp-wrap">
	<div id="sg-cover" style="width: 100%; height: 100%; display: none; position: absolute; z-index: 20; cursor: col-resize;"></div>
	<div id="sg-gen-container" style="height: 100%; text-align: center; margin: 0 auto;">
		<iframe id="sg-viewport" src="<?php echo $path; ?>"></iframe>
		<div id="sg-rightpull-container" style="width: 10px; float: right; margin: 0; height: 100%; cursor: col-resize;">
			<div id="sg-rightpull" style="margin: 0; width: 10px; height: 100%; background-color: #999;"></div>
		</div>
	</div>
</div>
<!--end iFrame-->
<!--end iFrame-->
<script src="styleguide/js/data-saver.js"></script>
<script src="styleguide/js/styleguide.js "></script>
</body>
</html>