<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens;


abstract class Token {
	protected $pattern;            // Regular expression pattern used to identify token in 
	                               // stream of characters.

	protected $name;               // Name of token type 

	protected $value; 

	public function __construct($string){
		$this->pattern = NULL; 
		$this->name = NULL; 
		$this->value = $string; 
	}

	public function getTokenType(){
		return $this->name; 
	}

	public function getPattern(){
		return $this->pattern;
	}

	public function setValue($value){
		$this->value = $value; 
	}

	public function getValue(){
		return $this->value; 
	}
	/*****************************************************************************/
	// Determine whether the beginning of the string matches the pattern for 
	// this token. If it does, peel off the match. Returns a boolean to 
	// indicate whether the input string matched the pattern for this token, 
	// the match, and the updated input string with the matched portion 
	// removed. 
	/*****************************************************************************/
	public function peelOff($value){
		$pattern = "/^" . $this->pattern . "/";

		// These are the results if we do not find a match. 
		$results = array("matched" => FALSE, 
			            "head" => NULL, 
			            "tail" => NULL);

        // First determine if the begining of the string matches the pattern 
        // for the token. If they do match, preg_match will return 1, and 
        // place the matches in $matches. 
		if(preg_match($pattern, $value, $matches)){

		    // We want to return the same string but with the match 
		    // removed from the begining. We do not need to call
		    // strpos. In order for there to be a match, the 
		    // match must be at the beginning of the string. So, 
		    // pos == 0. 
			$results["tail"] = trim(substr_replace($value, "", 0, strlen($matches[0])));
			$results["head"] = $matches[0];
			$results["matched"] = TRUE; 

		    return $results;
		}
		

		// If you get here, then $value does not match the pattern. 
		return $results;		
	}
	/*****************************************************************************/
	// Subclasses must implement this function!
	abstract public function isInstanceOfToken($info);
}
