<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagType; 

require_once("TagType.php");

class Addr extends TagType {
	function __construct($value){

		parent::__construct($value, "Addr");

		$this->specified_child_tags = array("cont","addr1","addr2","city","stae","post","ctry");

		// can be made up of any characters, but string must 
		// be between 1 and 60 characters
	    $this->rules["pattern"] = '/.{1,60}/'; 
	    $this->rules["can_be_null"] = FALSE; 
	}
}