<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomLineList;


class GedcomLineNode{
  private $level; 
  private $tag;
  private $xref; 
  private $value; 
  private $list_index; 
  private $undefined_tokens;           

  public function __construct($level, $list_index = 0){
    $this->level = $level; 
    $this->tag = NULL; 
    $this->xref = NULL; 
    $this->value = NULL; 

    $this->subordinate_lines = array();
    $this->parent = NULL; 

    $this->undefined_tokens = array();
    $this->list_index = $list_index; 
  }
  /*********************************************************************************************/
  public function setListIndex($index){
    $this->list_index = $index;
  }
  /*********************************************************************************************/
  public function getListIndex(){
    return $this->list_index;
  }
  /*********************************************************************************************/
  public function setLevel($level){
    $this->level = $level;
  }
  /*********************************************************************************************/
  public function setTag($tag){
    $this->tag = $tag; 
  }
  /*********************************************************************************************/
  public function setXRef($xref){
    $this->xref = $xref;
  }
  /*********************************************************************************************/
  public function setValue($value){
    $this->value = $value; 
  }
  /*********************************************************************************************/
  public function getLevel(){
    return $this->level;
  }
  /*********************************************************************************************/
  public function getTag(){
    return $this->tag;
  }
  /*********************************************************************************************/
  public function getValue(){
    return $this->value;
  }
  /*********************************************************************************************/
  public function getXRef(){
    return $this->xref;
  }
  /*********************************************************************************************/
  public function addUndefined($token){
    $this->undefined_tokens[] = $token; 
  }
  /*********************************************************************************************/
  public function isValid(){
    // Each Gedcom line must have a tag and a level
    return $this->tag !== NULL && $this->level !== NULL && count($this->undefined_tokens) === 0; 
  }
  /*********************************************************************************************/
  public function errorString(){
    if($this->isValid())
      return "";

    $invalidStr = "Line " . $this->getListIndex() . " is invalid because: ";

    $addComma = FALSE; 
    if($this->tag === NULL){
      $invalidStr .= "missing tag";
      $addComma = TRUE; 
    }

    if($this->level === NULL){
      if($addComma)
        $invalidStr .= ", ";

      $invalidStr .= "missing level";
      $addComma = TRUE; 
    }

    if(count($this->undefined_tokens) !== 0){
      if($addComma)
        $invalidStr .= ", ";

      $invalidStr .= "contains invalid tokens";
    }

    return $invalidStr . "\n"; 
  }
  /*********************************************************************************************/
  public function getUndefinedTokens(){
    return $this->undefined_tokens;
  }
  /*********************************************************************************************/
  public function __toString(){
    if(!$this->isValid()){
      $level = $this->level === NULL? "Null" : $this->level->getValue();
      $tag = $this->tag === NULL? "Null" : $this->tag->getValue();

      $outputStr .= "GedcomLineNode is invalid\n";
      $outputStr .= "Level: " . $level . "\n";
      $outputStr .= "Tag: " . $tag . "\n";
      $outputStr .= "Num undefined tokens: " . count($this->undefined_tokens);
    }
    else{
      $outputStr = "";
      $outputStr .= "Level: " . $this->level->getValue() . "\n";
      if($this->xref !== NULL) 
        $outputStr .= "XRref: " . $this->xref->getValue() . "\n";
      $outputStr .= "Tag: " . $this->tag->getValue() . "\n";
      if($this->value !== NULL)
        $outputStr .= "Value: " . $this->value->getValue() . "\n";
    }

    return $outputStr; 
  }
}