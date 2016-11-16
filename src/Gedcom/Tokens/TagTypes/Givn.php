<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Givn extends TagType {
	function __construct($value){
		$this->specified_child_tags = array();
		$this->rules["pattern"] = "/[ A-Za-z\-]{1,90}(,[ A-Za-z\-]{1,90})*/";
		$this->rules["can_be_null"] = FALSE; 
		$this->value = $value; 
	}
}