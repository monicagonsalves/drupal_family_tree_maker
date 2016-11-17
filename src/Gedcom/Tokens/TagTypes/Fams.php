<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Fams extends TagType {
	function __construct($value){
		parent::__construct($value, "Fams");
		$this->specified_child_tags = array();

		$this->rules["pattern"] =  self::XREF_PAT; 
	    $this->rules["can_be_null"] = FALSE; 
	}
}