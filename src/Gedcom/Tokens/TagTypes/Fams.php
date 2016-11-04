<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;


class Fams extends Tag {
	private $rule;              

	function __construct(){
		parent::__construct("Fams");
	}
}