<?php
namespace Drupal\family_tree_generator\Gedcom;

// Types of Tokens
use Drupal\family_tree_generator\Gedcom\Tokens\Level;
use Drupal\family_tree_generator\Gedcom\Tokens\Value;
use Drupal\family_tree_generator\Gedcom\Tokens\XRef;
use Drupal\family_tree_generator\Gedcom\Tokens\Undefined;
use Drupal\family_tree_generator\Gedcom\Tokens\Tag;

require_once("Tokens/Level.php");
require_once("Tokens/Value.php");
require_once("Tokens/XRef.php");
require_once("Tokens/Undefined.php");
require_once("Tokens/Tag.php");

class Lexer {
	private $line;                       // The index of the line we're on
	private $file_handler; 

	private $num_tokens_processed;       // The index of the token we're on in the current line. 
	private $buffer; 
	private $last_token_seen_is_tag = FALSE;  // Boolean that indicates whether the last token 
	                                          // is a tag


	public function __construct($file){
		// Open the file for reading
		$this->file_handler = fopen($file, "r");
		$this->line = 0; 
		$this->num_tokens_processed = 0; 

		// Initialize the buffer with the first line in the GEDCOM file
		$this->buffer= fgets($this->file_handler);
	}
	/*******************************************************************************/
	private function updateBuffer($isLastTokenInLine, $tail){
		if($isLastTokenInLine) {
			// If this is the last token in the line, then we need to 
			// update the buffer to hold the next line.
			$this->line += 1;     
			//$this->buffer = $this->stream[$this->line];
			$this->buffer = fgets($this->file_handler);

			// Also, if this is the last token in the line, then 
			// we need to reset $last_token_seen_is_tag to FALSE.
			$this->last_token_seen_is_tag = FALSE; 
			$this->num_tokens_processed = 0; 
		} 
		else {
			$this->buffer = $tail;
			$this->num_tokens_processed += 1;
		}
	}
	/*******************************************************************************/
	public function moreCharsLeft(){
		$read_in_all_lines = feof($this->file_handler);

		$more_tokens_exist = !$read_in_all_lines || !empty($this->buffer);

		// Because we are reading in one line at a time, the file pointer will 
		// reach the end of the file before we need to stop lexing. However, 
		// if we close our connection to the file before we've stopped lexing, 
		// then feof will always return TRUE, and our termination condition 
		// will also always return TRUE. Therefore, we should only close our 
		// connection to the file when we've processed all tokens. 
		if(!$more_tokens_exist)
			fclose($this->file_handler);

		return $more_tokens_exist;
	}
	/*******************************************************************************/
	// Function: getToken()
	// Input:    None
	// Output:   A Token object
	/*******************************************************************************/
	public function getToken(){
		// Sometimes a string will match multiple token patterns. For example, 
		// all strings will match the pattern for Undefined tokens. Therefore, 
		// the temporary Undefined token must always be at the end of the list,
		// so we attempt to match the string to the other tokens before declaring
		// it Undefined. In general, we must place a temporary token lower in the 
		// list if it will falsely match instances of other tokens. 
	    $token_prototypes = array(new Value(""),
		                          new Level(""),
		                          new XRef(""),
		                          new Tag(""),
		                          new Undefined(""));

		foreach($token_prototypes as $prototype){
			// Does the beginning of the buffer match the pattern for 
			// this token? 
			$results = $prototype->peelOff($this->buffer);

			if($results["matched"]){
				// We're going to construct an array of information 
				// to pass to the function that confirms the match 
				// is a valid instance of the current token. 
				$info["value"] = $results["head"];
				$info["isLastTokenInLine"] = $this->last_token_seen_is_tag ||
				                             empty($results["tail"]);
				$info["location"] = $this->num_tokens_processed;
				$info["lastTokenSeenIsTag"] = $this->last_token_seen_is_tag;

				if($prototype->isInstanceOfToken($info)){
					$prototype->setValue($results["head"]);
					break; 
				} // end if is instance of token
			} // end if string matched pattern*/
		} // end foreach

		$this->last_token_seen_is_tag = $prototype->getTokenType() === "Tag";
		$this->updateBuffer($info["isLastTokenInLine"], $results["tail"]);

		return $prototype; 
	} 
}
