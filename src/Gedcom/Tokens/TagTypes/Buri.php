<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\Tag; 

require_once("../Tag.php");

class Buri extends Tag {
	function __construct(){
		parent::__construct("Buri");

		$this->specified_child_tags = array("date","age","plac","addr");
	}
}