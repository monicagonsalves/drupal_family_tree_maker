<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens;

require_once("Token.php");
//require_once("TagTypes/TagTypeFactory.php");

class Tag extends Token {             
	//protected $specified_child_tags = NULL;
	//protected $user_defined_tags = NULL;
	//protected $tag_type_factory;

	//protected $tag_type_pattern = NULL; 

	public function __construct($string){
		parent::__construct($string);

		$this->pattern = "_?[A-Z0-9]+";    // A Tag can be any uppercase letter, 
										   // or digit. If it is a user defined 
		                                   // tag, then it must start with an 
		                                   // underscore. 

		$this->name = "Tag"; 

		//$this->tag_type_factory = new TagTypeFactory();
		//$this->user_defined_tags = array();
	}

	public function isInstanceOfToken($info){
		// A Tag can be any string
		return strlen($info["value"]) <= 31 && $info["location"] >= 1;
	}

	public function isUserDefined(){
		return preg_match("/^_[A-Z0-9]+/", $this->value);
	}
}