#!/usr/bin/php
<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes\Generator;

//require_once("../../Tag.php");

// List all files in the directory
$files = scandir("../");
foreach($files as $file){
	if(strpos($file, ".php") !== false && 
	   $file != "TagTypeFactory.php" &&
	   $file != "UserDefined.php")
	{
		// open the file 
		$fname = "../" . $file; 
		//$file_ptr = fopen($file, "r") or die("Unable to open file!");
		//$file_contents = fread($file_ptr,filesize($file));

		$fhandle = fopen($fname,"r");
		$content = fread($fhandle,filesize($fname));
		$content = str_replace("../Tag.php", "TagType.php", $content);
		$content = str_replace("Tag", "TagType", $content);

		$pattern = '/parent::__construct\(.+\);/';
		$content = preg_replace($pattern, '', $content);

		$fhandle = fopen($fname,"w");
		fwrite($fhandle,$content);
		fclose($fhandle);
	}
}

?>