<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomRecordSet;

use Drupal\family_tree_generator\Gedcom\GedcomLineList\GedcomLineList;
use Drupal\family_tree_generator\Gedcom\GedcomRecordSet\GedcomRecord\GedcomRecordNode;
use Drupal\family_tree_generator\Gedcom\GedcomRecordSet\GedcomRecord\GedcomRecordTree; 
use Drupal\family_tree_generator\Gedcom\Utility\ErrorHandler;

require_once("GedcomRecord/GedcomRecordNode.php");
require_once("GedcomRecord/GedcomRecordTree.php");
//require_once("../GedcomLineList/GedcomLineList.php");
require_once("Utility/ErrorHandler.php");


class GedcomRecordSet implements \IteratorAggregate{
  use ErrorHandler;

  private $set; 

  public function __construct($gedcom_line_list){
  	// Takes a GedcomLineList and peels off one sublist at a time
  	$gedcom_line_list->resetCurrent();
  	$count = 0; 
  	while($gedcom_line_list->moreListsToGet()){
  		$sublist = $gedcom_line_list->getSublist();

  		$gedcom_record = new GedcomRecordTree($sublist);
  	//	if($count === 0)
        $gedcom_record->create();

  		$this->set[] = $gedcom_record;

  		$count++; 
  	}
  }

  public function findErrors(){
    foreach($this->set as $record){
      if(!$record->isValid())
        $this->errors[] = $record;
    }
  }

  public function reportErrors(){
    $outputStr = "";
    for($i = 0; $i < count($this->errors); $i++)
    {
      $outputStr .= "Gedcom record " . $i . " is invalid.\n";
    }

    return $outputStr; 
  }

  public function getRecord($index){
  	return $this->set[$index];
  }

  public function getNumRecords(){
  	return count($this->set);
  }

  public function getIterator() {
	return new \ArrayIterator($this->set);
  }

  public function getLastRecord(){
    return $this->set[$this->getNumRecords()-1];
  }
}