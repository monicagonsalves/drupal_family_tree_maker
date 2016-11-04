<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens;

require_once("XRef.php");

class XRef extends Token {
	private $type;                                          // Is this a XRef pointer or an XRef
	                                                        // id? 

	public function __construct($string){
		parent::__construct($string);

		$this->pattern = "@[a-zA-Z0-9][^@\s]*@";      // A Tag can be any 
		                                                    // alphanumeric character

		$this->name = "XRef"; 
	}

	public function isInstanceOfToken($info){
		// A Tag can be any string, except 
		return $info["location"] >= 1;
	}
}