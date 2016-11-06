<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens;

require_once("Token.php");

class Undefined extends Token {                                          
	public function __construct($string){
		parent::__construct($string);

		$this->name = "Undefined"; 
	}

	public function isInstanceOfToken($info){
		// A Tag can be any string
		return TRUE; 
	}
}