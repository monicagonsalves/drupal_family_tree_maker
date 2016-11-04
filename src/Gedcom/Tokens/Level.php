<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens;

require_once("Token.php");

class Level extends Token {

	public function __construct($string){
		parent::__construct($string);

		$this->pattern = "(0|[1-9]\d?)";      // A Level must be a number between 0-99.

		$this->name = "Level"; 
	}

	public function isInstanceOfToken($info){
		// A level token must be the first token in a gedcom line.
		return $info["location"] === 0;
	}

	// Is this the start of a new record?
	public function isNewLogicalRecord(){
		return $this->value === "0";
	}
}