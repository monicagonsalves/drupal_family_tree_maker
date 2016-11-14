<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\Tag; 

require_once("../Tag.php");

class Addr extends Tag {
	function __construct(){
		parent::__construct("Addr");

		$this->specified_child_tags = array("cont","addr1","addr2","city","stae","post","ctry");
	}
}