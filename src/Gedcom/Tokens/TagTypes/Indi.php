<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypeTypeTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagTypeType; 

require_once("TagTypeTypeType.php");

class Indi extends TagTypeType {
	function __construct(){
		$this->specified_child_tags = array("sex","name","birt","deat","buri","crem","adop","fams","famc");
	}
}