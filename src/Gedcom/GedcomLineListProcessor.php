<?php

namespace Drupal\family_tree_generator\Gedcom;

use Drupal\family_tree_generator\Gedcom\GedcomLineList\GedcomLineList;
use Drupal\family_tree_generator\Gedcom\GedcomLineList\GedcomLineNode;
use Drupal\family_tree_generator\Gedcom\GedcomRecordSet\GedcomRecordSet;
use Drupal\family_tree_generator\Gedcom\Utility\ErrorHandler; 


require_once("GedcomLineList/GedcomLineList.php");
require_once("GedcomLineList/GedcomLineNode.php");
require_once("Lexer.php");
//require_once("GedcomRecordSet/GedcomRecordSet.php");
//require_once("Utility/ErrorHandler.php");

class GedcomLineListProcessor{
	//use ErrorHandler;
	// Properties
	private $lexer;
	private $gedcom_line_list;
	private $gedcom_record_set;
	//private $errors;  

	public function __construct($file){

		// The lexer generates tokens for us to process.
		$this->lexer = new Lexer($file);
		//$this->errors = new array();
	}
	/***************************************************************/
	// Function:     lex
	// Input:        None
    // Output:       GedcomLineList $gedcom_line_list
    // Description: 
    // The purpose of this function is convert a stream of characters
    // into a list of lines, where each line is a valid GedcomLine. 
    /***************************************************************/
	public function lex(){
		$current_line = NULL; 
		$gedcom_line_list = new GedcomLineList();
		$count = 1; 
		while($this->lexer->moreCharsLeft()){
			$token = $this->lexer->getToken();

			// The lexer gives us one token to process at a time. 
			// Our job is to convert the stream of tokens into a
			// a list of GedcomLines. To that end, we must 
			// determine which token signals the start of a new
			// line, and which tokens are parts of the current 
			// line. GedcomLines can only contain four types of 
			// tokens. Any other type of token is undefined and 
			// indicates the line we're processing is invalid.
			switch($token->getTokenType()){
				case "Level":
					$current_line = new GedcomLineNode($token, $count);
					$gedcom_line_list->addLine($current_line);
					$count++;
					break;
				case "Tag":
					$current_line->setTag($token);
					break;
				case "XRef":
					$current_line->setXRef($token);
					break;
				case "Value":
					$current_line->setValue($token);
					break;
				case "Undefined":
					$current_line->addUndefined($token);
			} // end switch
		} // end while 

		return $gedcom_line_list; 		
	}
	/***************************************************************/
	public function reportErrors(){
		if($this->gedcom_line_list->hasErrors())
			$this->gedcom_line_list->reportErrors();

		//if($this->gedcom_record_set->hasErrors())
		//	$this->gedcom_record_set->reportErrors();
	}
	/***************************************************************/
	public function getRecords(){
    	// Takes a GedcomLineList and peels off one sublist at a time
  		$this->gedcom_line_list->resetCurrent();
  		$count = 0; 
	  	while($this->gedcom_line_list->moreListsToGet())
	  	{
	  		$sublist = $this->gedcom_line_list->getSublist();
	  		$count++; 
		}
	}
	/***************************************************************/
	public function process(){  
		// 1. First, we are going to lex the file, and create a list 
		// of all the lines in the file. 
		$this->gedcom_line_list = $this->lex();

		// At this point, we should know whether any of the lines are 
		// malformed. A Gedcom line has the following grammar syntax
		// (taken from the Gedcom 5.5 specification):
		// gedcom_line := level+delim+optional_xref_id+tag+delim
		//                +optional_line_value+\n

		// 2. Now we're going to split the list into sublists where 
		// each sublist is a linear representation of a logical 
		// record. 
		$this->gedcom_line_list->partition();

		// 3. Next, we must determine the hierarchal structure of each
		// sublist. Doing so, converts a sublist of GedcomLines into 
		// a GedcomRecord. At the end of the function call, 
		// we will have a set of GedcomRecords. 
		//$this->gedcom_record_set = new GedcomRecordSet($this->gedcom_line_list);

		// The following foreach was for testing purposes
		//foreach($this->gedcom_record_set as $gedcom_record)
		//	echo $gedcom_record; 


	}
}