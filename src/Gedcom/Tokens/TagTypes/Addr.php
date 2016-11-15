<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Addr extends TagType {
	function __construct(){
		
		$this->specified_child_tags = array("cont","addr1","addr2","city","stae","post","ctry");
	}
}