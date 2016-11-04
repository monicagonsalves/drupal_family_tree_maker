<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomRecordSet\GedcomRecord;

use Drupal\family_tree_generator\Gedcom\GedcomLineList\GedcomLineNode;

//require_once("../../GedcomLineList/GedcomLineNode.php");

class GedcomRecordNode{
  private $line;  
  private $parent; 
  private $index; 
  private $depth; 
  private $children;

  public function __construct(GedcomLineNode $line, $index){ 
  	$this->line = $line;
  	$this->parent = NULL; 
  	$this->children = array();
    $this->index = $index; 
   // $this->depth = $line->getLevel()->getValue(); 
  }

  public function getLine(){
    return $this->line; 
  }

  public function setParent(GedcomRecordNode $parent){
  	$this->parent = $parent;
  }

  public function addChild(GedcomRecordNode $child){
    // $index = the index of the node in the set of GedcomRecordNodes, 
    // NOT the index of the node in $this->children. 
  	$this->children[] = $child;
  }
  public function getParent(){
    return $this->parent;
  }

  public function getChild($index){
    return $this->children[$index];
  }

  public function getChildren(){
    return $this->children;
  }

  public function hasChildren(){
    return $this->getNumChildren() > 0; 
  }

  public function getNumChildren(){
    return count($this->children);
  }

  public function setDepth($depth){
    $this->depth = $depth;
  }

  public function getDepthString(){
    $outputStr = "";
    for($i = 0; $i < $this->depth; $i++)
      $outputStr .= "-";
    return $outputStr;
  }

  public function getDepth(){
    return $this->depth; 
  }

  public function __toString(){
    $outputStr = $this->getDepthString();
    if($outputStr !== "")
      $outputStr .= " ";
    $outputStr .=  $this->getLine()->getListIndex();
    return $outputStr; 
  }
}