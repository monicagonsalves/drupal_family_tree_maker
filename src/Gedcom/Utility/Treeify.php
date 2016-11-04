<?php
namespace Drupal\family_tree_generator\Gedcom\Utility;

// --- Defines a set of functions that all tree traversal traits 
// must override.  
trait TraversableTree{
  // Whatever we "take away" from our visits to a node 
  public $souvenirs = array(); 

  // Function that actually traverses the tree. This must 
  // be implemented by a trait that uses this one. 
  abstract public function traverse($start);

  // The function that processes individual nodes. This 
  // must be implemented by a class. 
  abstract public function visit($node);
}

trait BreadthFirst {
  use TraversableTree; 

  public function traverse($start){
    // Initialize the frontier with the starting node
    $frontier = array($start);

    // While there are still nodes left to fully explore...
    while(!empty($frontier)){
      // Take off the node at the beginning of the array
      $current = array_shift($frontier);

      // If the current node has children, then add them to 
      // frontier to indicate we've noticed them, but we haven't
      // fully explored them yet. 
      if($current->hasChildren())
        $frontier = array_merge($frontier, $current->getChildren());

      $this->visit($current);
    }
  }
}

trait DepthFirst{
  use TraversableTree; 

  // Define what work needs to be done before we visit the node. 
  abstract public function preOrderVisit($node);
  // Define what work needs to be done after we visit the node. 
  abstract public function posOrdertVisit($node);
  abstract public function inOrderVisit($node);


}