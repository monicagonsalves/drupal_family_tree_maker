<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagRuleList;

use Drupal\family_tree_generator\Gedcom\Utility\Range;

require_once("../../Utility/Range.php");

class TagRuleNode{
  private $range_of_num_children; 
  private $associated_tag_name; 
  private $children;       // An adjacency list 
  private $pattern; 

  // meta information
  private $color; 

  public function __construct($tag_name, $str = "", $parent = NULL){
  	$this->children = array();  // An array of TagRuleNodes
  	$this->pattern = NULL; 
  	$this->associated_tag_name = $tag_name; 
    $this->color = 0; 
    $this->str = $str; 
    $this->parent = $parent; 
  }

  public function setRange(Range $range){
  	$this->range_of_num_children = new Range($range);
  }

  public function addChild(TagRuleNode $rule){
  	$this->children[] = $rule; 
  }

  public function setParent(TagRuleNode $parent){
    $this->parent = $parent; 
  }

  public function setPattern($pattern){
  	$this->pattern = $pattern;
  }

  public function matchesPattern(){
  	return (($this->pattern !== NULL)? preg_match($this->pattern, $this->str) : false); 
  }

  public function getChildren(){
    return $this->children; 
  }

  public function goWhite(){
    $this->color = 0;
  }

  public function goBlack(){
    $this->color = 1;
  }

  public function getColor(){
    return $this->color; 
  }

  public function isBlack(){
    return $this->color === 1; 
  }

  public function isLeaf(){
    return $this->getNumChildren() === 0; 
  }

  public function hasChildren(){
    return $this->getNumChildren() !== 0; 
  }

  public function getNumChildren(){
    return count($this->child_rules);
  } 

  public function isDummy(){
    return $this->associated_tag_name = "Dummy";
  }

  public function isValid(){
    return $this->matchesPattern() && $this->range_of_num_children->contains($this->getNumChildren());
  }
}