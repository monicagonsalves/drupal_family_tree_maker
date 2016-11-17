<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Fam extends TagType {
	function __construct($value){
		parent::__construct($value, "Fam");
		$this->specified_child_tags = array("husb","wife","chil","nchi"); 
	    $this->rules["can_be_null"] = TRUE; 
	}
}