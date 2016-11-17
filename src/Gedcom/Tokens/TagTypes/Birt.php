<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Birt extends TagType {
	function __construct($value){
		parent::__construct($value, "Birt");
		$this->specified_child_tags = array("famc","date","plac","addr");

		$this->rules["pattern"] = self::YEAR_PAT; 
	    $this->rules["can_be_null"] = TRUE; 
	}
}