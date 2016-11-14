<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\Tag; 

require_once("../Tag.php");

class Indi extends Tag {
	function __construct(){
		parent::__construct("Indi");

		$this->specified_child_tags = array("sex","name","birt","deat","buri","crem","adop","fams","famc");
	}
}