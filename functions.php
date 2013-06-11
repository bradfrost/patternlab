<?php 

$root = $_SERVER['DOCUMENT_ROOT']; 

//This changes the root path of the project. It might live at the root or at a subdirectory like /styleguide
$absolutePath = '/';

$patternsPath = $root.$absolutePath.'patterns/';

/************** 
Include Function 
Make including files easier. Simply declare the type of fragment you're looking for (atom, molecule, organism, or page) and the name of the file (with no extention)

Takes two variables:
Type: the type of pattern you're looking to include. Options are: atom, molecule, organism, or page
Name: the name of the file
	
************** */


/**
 * Provide a filter for excluding hidden .git or .svn folders from the inc() function
 */
class ExcludeFilter extends RecursiveFilterIterator {
	
	public static $FILTERS = array(
		'.svn',
		'.git'	
	);
	
	public function accept() {
		//Check if a file is within one of the folders listed in the exclude list
		foreach(self::$FILTERS as $filter) {
			if(strpos($this->current()->getPath(),$filter)) {
				return false;
			}
		}
		return true;
	}
}




function inc($type,$name) {
	global $patternsPath; 
	global $absolutePath;
	
	$filePath = $patternsPath;

	//Determine which directory to look in based on type: atom, molecule, organism or page
	if($type=='atom') {
		$filePath = $filePath.'00-Atoms';
	} elseif($type=='molecule') {
		$filePath = $filePath.'01-Molecules';
	} elseif($type=='organism') {
		$filePath = $filePath.'02-Organisms';
	} elseif($type=='page') {
		$filePath = $filePath.'03-Pages';
	} else {
		$filePath = $filePath;
	}
	
	
	//Iterate over the appropriate path
	$objects = new RecursiveIteratorIterator(new ExcludeFilter(new RecursiveDirectoryIterator($filePath)));
	foreach($objects as $objName => $object){
	
		$pos = stripos($objName, $name);
		
		if ($pos) {
		    include($objName); //Include the fragment if the file is found
		    break;
		} 
	}
}
