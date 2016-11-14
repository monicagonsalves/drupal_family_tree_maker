#!/usr/bin/php
<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes\Generator;

require_once("../../Tag.php");


$file_ptr = fopen("TagTypeFileTemplate.php", "r") or die("Unable to open file!");
$template = fread($file_ptr,filesize("TagTypeFileTemplate.php"));

/*********************************************************************************/
function welcomeHeader(){
	echo "===========================================================\n";
	echo "TAG TYPE FILE GENERATOR\n";
	echo "===========================================================\n";
}
/*********************************************************************************/
function insertQuotesInTL($tl, $current_tag){
	if($tl[0] === "")
		return "";

	$temp = array();
	foreach($tl as $tag){
		if(ucfirst($tag) !== $current_tag)
			$temp[] = '"' . $tag . '"';
	}

	return $temp;
}
/*********************************************************************************/
function makeFile(){
	$tag_type = ucfirst(readline("Enter tag type name: "));

	// Get list of comma separated tag types and convert it into a string 
	// to sub in template. 
	$tag_list = explode(',', readline("Enter a list of comma separated tag types current tag type depends on: "));
	$tag_list_str = implode(',', insertQuotesInTL($tag_list, $tag_type));

	$file_str = str_replace(array( "TAG_TYPE_NAME", 
		                           "TAG_TYPE_LIST" ), 
	                        array( $tag_type,
	                 	           $tag_list_str ), 
	                        $GLOBALS["template"]);

	// Open and write to the file
	echo "Would you like to create the file " . $tag_type . ".php with the following content?: \n" ;
	echo $file_str;

	$create_it = readline("\nEnter y/n: ");

	if($create_it === "y")
	{
		$file_handle = fopen("../" . $tag_type . ".php", "w");
		fwrite($file_handle, $file_str);
		fclose($file_handle);

		echo "\nYou have successfully created " . $tag_type . ".php\n";
	}
	else
	{
		echo "Did not create file " . $tag_type . ".php\n";
	}
}
/*********************************************************************************/
welcomeHeader();
makeFile();

?>