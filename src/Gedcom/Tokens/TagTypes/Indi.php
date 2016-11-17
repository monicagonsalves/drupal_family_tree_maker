<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Indi extends TagType {
	function __construct($value){
		parent::__construct($value, "Indi");
		$this->specified_child_tags = array("sex","name","birt","deat","buri","crem","adop","fams","famc");

		$this->rules["can_be_null"] = TRUE; 
	}
}