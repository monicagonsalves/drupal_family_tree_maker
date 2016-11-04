<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens;


class TokenHelper {
	public static function getTagTypes(){
		// retreive a list of tag types from the TagTypes folder
		$directory = getcwd() . "/TagTypes";
		$files = scandir($directory);

		$tagTypes = array();

		foreach($files as $file){
			// Make sure it is a valid file name, and not "..", or "."
			$pos = strpos($file, ".php");

			if($pos !== false )
				// Extract the tag type from the string $file, 
				// and convert it to uppercase. 
				$tagTypes[] = strtoupper(substr($file, 0, $pos));
		}

		return $tagTypes;
	}
}