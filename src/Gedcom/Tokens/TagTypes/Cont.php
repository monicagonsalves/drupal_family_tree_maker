<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Cont extends TagType {
	function __construct($value){
		parent::__construct($value, "Cont");
		$this->specified_child_tags = array();

		// can be made up of any characters, but string must 
		// be between 1 and 60 characters
	    $this->rules["pattern"] = self::ANY_STR_PAT; 
	    $this->rules["can_be_null"] = FALSE; 
	}
}