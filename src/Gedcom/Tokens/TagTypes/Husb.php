<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Husb extends TagType {
	function __construct(){
		$this->specified_child_tags = array();
	}
}