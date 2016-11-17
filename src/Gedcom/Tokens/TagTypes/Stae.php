<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Stae extends TagType {
	function __construct(){
		parent::__construct($value,"Stae");
		$this->specified_child_tags = array();
	}
}