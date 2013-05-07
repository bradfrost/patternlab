<?php include_once('../../functions.php'); ?>
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