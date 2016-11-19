<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomLineList;

use Drupal\family_tree_generator\Gedcom\Utility\ErrorHandler;

require_once("SplittableTrait.php");
//echo getcwd();
// FIX THIS SO THAT WE INCLUDE THIS RELATIVE TO THE LOCATION OF THIS FILE AND NOT
// THE LOCATION OF THE DRIVER
$relpath = getcwd() . "/modules/custom/family_tree_generator/src/Gedcom/Utility/";
require_once($relpath . "ErrorHandler.php");

class GedcomLineList implements \Countable{

  use Splittable; 
  use ErrorHandler; 

  protected $list;                   // Basically a linked list where each 
                                     // element is a GedcomLineNode
  //***********************************************************************************/
  public function __construct(){
    $this->list = array();           // We're going to use the builtin array to 
                                     // store the list.  

    $this->errors = array();
  } 
  //***********************************************************************************/
  public function getNumLines(){
  	return count($this->list);
  }
  //***********************************************************************************/
  public function getLastLine(){
  	return end($this->list);
  }
  //***********************************************************************************/
  public function getList(){
  	return $this->list; 
  }
  //***********************************************************************************/
  public function getLine($index){
  	return $this->list[$index];
  }
  //***********************************************************************************/
  public function addLine(GedcomLineNode $line){
  	$this->list[] = $line; 
  }
  //***********************************************************************************/
  public function findErrors(){
    // Invalid lines 
    foreach($this->list as $line)
    {
      // If the line is invalid, add it to the list of invalid lines
      if(!$line->isValid())
        $this->errors[] = $line; 
    }
  }
  //***********************************************************************************/
  public function reportErrors(){
    $error_str = "";
    foreach($this->errors as $invalid_line)
      $error_str .= $invalid_line->errorString();
    
    return $error_str;
  }
  //***********************************************************************************/
  public function count(){
    return count($this->list);
  }
  //***********************************************************************************/
  public function partition(){
  	for($i = 0; $i < $this->getNumLines(); $i++){
  		$line = $this->getLine($i);

  		if($line->getLevel()->isNewLogicalRecord())
  			$this->partition_points[] = $i;
  	}
  }
  //***********************************************************************************/
  // Does not reset $this->current_sublist for you! You must handle the resetting
  // on your own!
  public function getSublist(){
    $start = $this->partition_points[$this->current_sublist];
    $end = $this->partition_points[$this->current_sublist+1];

    $length = $end - $start; 
    if($length < 0)
      $length = 1; 

  	$temp = array_slice($this->getList(), $start, $length);
    $sublist = new GedcomLineList();

    foreach($temp as $line)      
      $sublist->addLine($line);

  	$this->current_sublist++; 

  	return $sublist; 
  }
}