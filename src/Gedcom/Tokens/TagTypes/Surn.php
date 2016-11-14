<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\Tag; 

require_once("../Tag.php");

class Surn extends Tag {
	function __construct(){
		parent::__construct("Surn");

		$this->specified_child_tags = array();
	}
}