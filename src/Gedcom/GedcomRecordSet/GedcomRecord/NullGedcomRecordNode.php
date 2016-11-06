<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomRecordSet\GedcomRecord;

use Drupal\family_tree_generator\Gedcom\GedcomLineList\GedcomLineNode;

//require_once("../../GedcomLineList/GedcomLineNode.php");

class NullGedcomRecordNode extends GedcomRecordNode{
  public function __construct(){ 
  	$this->line = NULL;
  	$this->parent = NULL; 
  	$this->children = array();
  	$this->index = -1;
  }

  public function __toString(){
  	$outputStr = "-1";
  	return $outputStr; 
  }
}