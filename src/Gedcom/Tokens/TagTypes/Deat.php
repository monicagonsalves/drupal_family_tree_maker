<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Deat extends TagType {
	function __construct($value){
		parent::__construct($value, "Deat");
		$this->specified_child_tags = array("date","age","plac","addr");

		$this->rules["pattern"] =  self::YEAR_PAT; 
	    $this->rules["can_be_null"] = TRUE; 
	}
}