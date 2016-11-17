<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Famc extends TagType {
	function __construct($value){
		parent::__construct($value, "Famc");

		$this->specified_child_tags = array("pedi");

		$this->rules["pattern"] =  self::XREF_PAT; 
	    $this->rules["can_be_null"] = FALSE; 
	}
}