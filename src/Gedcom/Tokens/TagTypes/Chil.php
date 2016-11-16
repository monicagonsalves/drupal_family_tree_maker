<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Chil extends TagType {
	function __construct($value){
		$this->specified_child_tags = array();

		$this->rules["pattern"] =  self::XREF_PAT; 
	    $this->rules["can_be_null"] = TRUE; 
	    $this->value = $value; 
	}
	}
}