<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Sex extends TagType {
	function __construct(){
		$this->specified_child_tags = array();

		$this->rules["pattern"] = "/[M|F|Male|Female|male|female|m|f]/";
		$this->rules["can_be_null"] = FALSE; 
		$this->value = $value; 
	}
}