<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Date extends TagType {
	function __construct($value){
		$this->specified_child_tags = array();

		// can be made up of any characters, but string must 
		// be between 1 and 60 characters
	    $this->rules["pattern"] = "/\d?\d (JAN|FEB|MAR|MAY|JUN|JUL|AUG|SEP|OCT|NOV|DEC) \d\d\d\d(/\d\d)?/";
	    $this->rules["can_be_null"] = FALSE; 
	    $this->value = $value; 
	}
}