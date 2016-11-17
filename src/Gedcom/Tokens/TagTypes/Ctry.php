<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Ctry extends TagType {
	function __construct($value){
		parent::__construct($value, "Ctry");
		$this->specified_child_tags = array();


		// can be made up of any characters, but string must 
		// be between 1 and 60 characters
	    $this->rules["pattern"] = '/.{1,60}/'; 
	    $this->rules["can_be_null"] = FALSE; 
	}
}