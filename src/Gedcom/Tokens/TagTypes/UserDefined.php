<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;


class UserDefined extends Tag {           
	private $subname; 

	function __construct($sn){
		parent::__construct("UserDefined");

		$this->subname = $sn; 
	}
}