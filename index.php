<?php
	include_once('functions.php');
	$url = $_GET["url"];
	
	if($url) {
		$path = "view.php/?url=".$url;
	} else {
		$path = "styleguide.php";
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pattern Lab</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="styleguide/css/styleguide.css" media="all" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="styleguide/js/jquery.js"><\/script>')</script>
</head>
<body>
<!--Style Guide Header-->
<header class="sg-header" role="banner">
	<a href="#sg-nav-container" class="sg-nav-toggle">Menu</a>
	<div class="sg-nav-container" id="sg-nav-container">
		<!--Begin Pattern Navigation-->
		<ol class="sg-nav">
			<?php 

			/* Loop through patterns directory and sub-directories */
			function listFolderFiles($dir,$exclude){ 
			    global $patternsPath;
			    $ffs = scandir($dir);
			    
			    foreach($ffs as $ff){ 
			        if(is_array($exclude) and !in_array($ff,$exclude)){ 
			            if($ff != '.' && $ff != '..'){
			            	$fName = basename($ff,'.php');
					    	$noNum = substr(strstr($fName,"-"), 1);
					    	$fPlain = str_replace("-", " ", $noNum);
					    	$fCaps = ucwords($fPlain);
					    	$pathToFile = str_replace($patternsPath, "", $dir);
			            	
				            if(is_dir($dir.'/'.$ff)){ /*If main section */
				            	echo '<li class="sg-nav-'.$fCaps.'"><a href="?url='.$pathToFile.'/'.$ff.'" class="sg-acc-handle">'.$fCaps.'</a><ol class="sg-acc-panel">'; 
				            } else { /* If SubItem */
				            	//if(strlen(strstr($ff, '.', true)) < 1) continue; //Continue if hidden file
				           		echo '<li><a href="?url='.$pathToFile.'/'.$ff.'" class="sg-pop">'.$fCaps.'</a></li>';
				            } 
				            
				            if(is_dir($dir.'/'.$ff)) {
				            	listFolderFiles($dir.'/'.$ff,$exclude);
				            }
			            	
			            	if(is_dir($dir.'/'.$ff)){ /*If main section */
			            		echo '</ol></li>';
			            	}
			            } 
			        } 
			    } 
			} 

			listFolderFiles($patternsPath,array('index.php')); 
			?>
			<li><a href="<?php echo $absolutePath; ?>">All</a></li>
		</ol>
		<!--End Pattern Navigation-->
		
		<!--Begin Controls-->
		<div class="sg-controls" id="sg-controls">
				<div class="sg-control-content">
					<ul class="sg-control">
						<li class="sg-view">
							<a href="#" class="sg-acc-handle sg-control-trigger" id="sg-t-toggle">View</a>
							<ul class="sg-view sg-acc-panel" id="sg-view">
								<li><a href="#" id="sg-t-annotations">Annotations</a></li>
								<li><a href="#" id="sg-t-code">Code</a></li>
								<li><a href="#" id="sg-t-clean">Clean</a></li>
								<li><a href="<?php echo $path; ?>" target="_blank">Raw</a></li>
							</ul>
						</li>
						<li class="sg-size">
							<div class="sg-current-size sg-acc-handle">Size <span class="sg-input sg-size-px" contenteditable>320</span>px / <span class="sg-input sg-size-em" contenteditable>20</span>em</div>
							<ul class="sg-acc-panel sg-size-options">
								<li class="sg-quarter"><a href="#" id="sg-size-s">S</a></li> 
								<li class="sg-quarter"><a href="#" id="sg-size-m">M</a></li>
								<li class="sg-quarter"><a href="#" id="sg-size-l">L</a></li>
								<li class="sg-quarter"><a href="#" id="sg-size-xl">XL</a></li>
								<li class="sg-half"><a href="#" id="sg-size-full">Full</a></li>
								<li class="sg-half"><a href="#" id="sg-size-random">Random</a></li>
								<li class="sg-half"><a href="#" class="mode-link" id="sg-size-disco">Disco</a></li>
								<li class="sg-half"><a href="#" class="mode-link" id="sg-size-hay">Hay!</a></li>
							</ul>
						</li>
					</ul>
				</div>
		</div>
		<!--End Controls-->
	</div>
</header>
<!--End Style Guide Header-->


<!-- Iframe -->
<div id="sg-vp-wrap">
	<div id="sg-cover"></div>
	<div id="sg-gen-container">
		<iframe id="sg-viewport" src="<?php echo $path; ?>"></iframe>
		<div id="sg-rightpull-container">
			<div id="sg-rightpull"></div>
		</div>
	</div>
</div>
<!--end iFrame-->

<script src="styleguide/js/data-saver.js"></script>
<script src="styleguide/js/styleguide.js "></script>
</body>
</html>