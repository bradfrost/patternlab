<?php
	include_once('functions.php');
	$path = isset($_GET["url"]) ? "view.php/?url=".$_GET["url"] : "styleguide.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pattern Lab</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="styleguide/css/styleguide.css" media="all" />
    <link rel="stylesheet" href="styleguide/css/annotations.css" media="all" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="styleguide/js/jquery.js"><\/script>')</script>
</head>
<body class="sg-nav-wrapper">
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
				            	if(pathinfo($ff,PATHINFO_EXTENSION) == 'php') { //Skip non-PHP files
					           		echo '<li><a href="?url='.$pathToFile.'/'.$ff.'" class="sg-pop">'.$fCaps.'</a></li>';
					           	}
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
						<li class="sg-nav-phases">
							<a href="#" class="sg-acc-handle">Phases</a>
							<ul class="sg-acc-panel">
								<?php 
								/* Loop through SASS/SCSS files to find Phases */	
								
								function rglob($pattern='*', $flags = 0, $path='')
								{
								    $paths=glob($path.'*', GLOB_MARK|GLOB_ONLYDIR|GLOB_NOSORT);
								    $files=glob($path.$pattern, $flags);
								    foreach ($paths as $path) { $files=array_merge($files,rglob($pattern, $flags, $path)); }
								    return $files;
								}
								
								function listSassVariables($dir){
									$ffs = rglob('*.{sass,scss}', GLOB_BRACE, $dir);
									
									foreach($ffs as $ff){
										if($ff != '.' && $ff != '..'){
											$contents = file_get_contents($ff);
											$pattern = '/\$bp-(.*?):(.*?);/';
											
											if(preg_match_all($pattern, $contents, $matches)){
												//$phases = array_unique($matches[2]);
												for($i = 0; $i < count($matches[0]); ++$i){
													echo '<li><a href="#" class="sg-size" data-size="'.trim($matches[2][$i]).'">'.trim($matches[1][$i]).'</a></li>';
												}
											}
										}
									}
								}
		
								listSassVariables($sassPath);
								?>
							</ul>
						</li>
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
							<div class="sg-current-size"><form id="sg-form">Size <input type="text" class="sg-input sg-size-px" value="320">px / <input type="text" class="sg-input sg-size-em" value="20">em</form></div>
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
<script src="styleguide/js/annotations-viewer.js "></script>
</body>
</html>