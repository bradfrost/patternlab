<?php include_once('functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Style Guide</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="styleguide/css/styleguide.css" media="all" />
    <link rel="stylesheet" href="css/style.css" media="all" />
</head>
<body>

<!--Style Guide Main Content-->
<div class="sg-main" role="main">

<!--Patterns-->
<div id="patterns">
<?php 

/* Loop through patterns directory and sub-directories */
function displayPatterns($dir,$exclude){ 
    
    global $patternsPath;
    global $absolutePath;
    
    $ffs = scandir($dir); 
    
    
    //Loop through directories
    foreach($ffs as $ff){ 
        if(is_array($exclude) and !in_array($ff,$exclude)){ 
            if($ff != '.' && $ff != '..'){
            	$fName = basename($ff,'.php');
		    	$noNum = substr(strstr($fName,"-"), 1);
		    	$fPlain = str_replace("-", " ", $noNum);
		    	$fCaps = ucwords($fPlain);
		    	$pathToFile = str_replace($patternsPath, "", $dir);
            	
	            if(is_dir($dir.'/'.$ff)){ /*If main section */
	            	echo '<div class="sg-section" id="'.$fName.'">';
	            } else { /* If SubItem */
	            	if(pathinfo($ff,PATHINFO_EXTENSION) == 'php') { //Skip non-PHP files
		           		echo '<h2 class="sg-head sg-sub" id="'.$fName.'"><a href="'.$absolutePath.'?url='.$pathToFile.'/'.$ff.'" class="sg-pop">'.$fCaps.'</a></h2>';
				    	echo '<div class="sg-pattern">';
				    	include $dir.'/'.$ff;
				    	echo '</div>';
	            	}
	            } 
	            
	            if(is_dir($dir.'/'.$ff)) {
	            	if($ff!='03-Templates' || $ff!='04-Pages') { //Exclude displaying the templates 
	            		displayPatterns($dir.'/'.$ff,$exclude);
	            	}
	            }
            	
            	if(is_dir($dir.'/'.$ff)){ /*If main section */
                    echo '</div>';
            		echo '<!-====================================================================================================-->';
            	}
            } 
        } 
    } 
} 

displayPatterns($patternsPath,array('index.php')); 
?>

</div> <!--end #patterns-->
</div><!--End Style Guide Main Content-->
</body>
</html>