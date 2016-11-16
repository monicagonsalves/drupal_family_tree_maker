<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Name extends TagType {
	function __construct($value){
		$this->specified_child_tags = array("givn","surn");

		$this->rules["pattern"] = "/[ A-Za-z\-]* (\/[ A-Za-z\-]+\/)*/";
		$this->rules["can_be_null"] = FALSE; 
		$this->value = $value; 
	}
}