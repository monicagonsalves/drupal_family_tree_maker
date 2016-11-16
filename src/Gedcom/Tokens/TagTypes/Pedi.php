<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Pedi extends TagType {
	function __construct($value){
		$this->specified_child_tags = array();

	    $this->rules["pattern"] = '/adopted|birth|foster|sealing/'; 
	    $this->rules["can_be_null"] = FALSE; 
	    $this->value = $value; 
	}
}