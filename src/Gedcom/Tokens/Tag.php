<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens;

require_once("Token.php");
class Tag extends Token {
	private $rule;              

	function __construct($string){
		parent::__construct($string);

		$this->pattern = "_?[A-Z0-9]+";    // A Tag can be any uppercase letter, 
										   // or digit. If it is a user defined 
		                                   // tag, then it must start with an 
		                                   // underscore. 

		$this->name = "Tag"; 
	}

	public function isInstanceOfToken($info){
		// A Tag can be any string
		return strlen($info["value"]) <= 31 && $info["location"] >= 1;
	}
}