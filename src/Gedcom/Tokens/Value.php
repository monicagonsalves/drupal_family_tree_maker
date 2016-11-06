<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens;

require_once("Token.php");
class Value extends Token {

	// A value is associated with a tag. 
	private $associated_tag;

	public function __construct($string){
		parent::__construct($string);
		
		$this->pattern = ".*";                      // A value can be any sequence of characters
                                                   
		$this->name = "Value"; 
		$this->associated_tag = NULL; 
	}

	public function isInstanceOfToken($info){
		// A line value exists in conjuctions with a tag. 
		return  $info["isLastTokenInLine"] && $info["lastTokenSeenIsTag"];
	}

	public function setAssociatedTag($tag){
		$this->associated_tag = $tag; 
	}

	public function getAssociatedTag(){
		return $this->associated_tag;
	}
}