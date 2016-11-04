<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomLineList;

trait Splittable{
  protected $partition_points = array();
  protected $current_sublist = 0; 

  // TO DO: Turn this into a function that accepts a condition 
  // for splitting a list as one of its input parameters, and 
  // also the list we are splitting as the second input. Then instead
  // of having an abstract function, write a concrete function. 
  abstract public function partition();
  abstract public function getSublist();

  public function getPartitionPoints(){
    return $this->partition_points; 
  }

  public function resetCurrent(){
    $this->current_sublist = 0; 
  }

  public function getNumSublists(){
    return count($this->partition_points);
  }

  public function moreListsToGet(){
    return $this->current_sublist < $this->getNumSublists();
  }

  public function getAllSublists(){
    $sublists = array();
    $this->resetCurrent();
    while($this->moreListsToGet())
      $sublists[] = $this->getSublist();

    return $sublists; 
  }
}