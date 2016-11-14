#!/usr/bin/php
<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes\Generator;

//require_once("../../Tag.php");

// List all files in the directory
$files = scandir("../");
$total_missing = 0; 
foreach($files as $file){
	if(strpos($file, ".php") !== false && 
	   $file != "TagTypeFactory.php" &&
	   $file != "UserDefined.php")
	{
		// open the file 
		$file = "../" . $file; 
		$file_ptr = fopen($file, "r") or die("Unable to open file!");
		$file_contents = fread($file_ptr,filesize($file));

		// locate the list of child tag types
		preg_match("/array\(.*\);/", $file_contents, $output_array);

		$eval_str = "\$curr = " . $output_array[0]; 
		
		eval($eval_str);

		foreach($curr as $child_tag_type_file)
			if(!in_array(ucfirst($child_tag_type_file) . ".php", $files))
				$total_missing += 1; 
	}
}

if($total_missing > 0)
	echo "We have not created a file for each tag type.\n";
else 
	echo "Success!\n";
?>