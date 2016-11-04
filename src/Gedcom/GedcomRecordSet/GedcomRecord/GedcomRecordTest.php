<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomRecordList;

use Drupal\family_tree_generator\Gedcom\GedcomLineList\GedcomLineNode;

require_once("../GedcomLineList/GedcomLineNode.php");

class GedcomRecordNode{
  private $line;  
  private $parent; 
  private $children;

  public function __construct(GedcomLineNode $line){ 
  	$this->line = $line;
  	$this->parent = NULL; 
  	$this->children = array();
  }

  public function setParent(GedcomRecordNode $parent){
  	$this->parent = $parent;
  }

  public function addChild(GedcomRecordNode $child){
  	$this->children[] = $child;
  }

  public function getParent(){
  	return $this->parent;
  }

  public function getChildren(){
  	return $this->children;
  }

  public function getChild($index){
  	return $this->children[$index];
  }
}