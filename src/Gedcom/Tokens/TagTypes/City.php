<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypeTypeTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagTypeType; 

require_once("TagTypeTypeType.php");

class City extends TagTypeType {
	function __construct(){
		$this->specified_child_tags = array();
	}
}