<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Nchi extends TagType {
	function __construct($value){
		$this->specified_child_tags = array();

		$this->rules["pattern"] = "/\d{1,3}/";
		$this->rules["can_be_null"] = FALSE; 
		$this->value = $value; 
	}
}