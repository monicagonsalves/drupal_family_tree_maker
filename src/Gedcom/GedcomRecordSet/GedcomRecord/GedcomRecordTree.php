<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomRecordSet\GedcomRecord;

use Drupal\family_tree_generator\Gedcom\GedcomLineList\GedcomLineList;

//require_once("../../GedcomLineList/GedcomLineList.php");
require_once("GedcomRecordNode.php");
require_once("NullGedcomRecordNode.php");

class GedcomRecordTree implements \Countable{
  private $sublist; // The unstructured gedcom record
  private $nodes;   // A set of nodes that make up the tree. Each node in the corresponds
                    // with a line in the sublist. 

  private $valid; 

  public function __construct(GedcomLineList $sublist){ 
  	$this->sublist = $sublist;
    $this->valid = TRUE; 
  }
  /***************************************************************************************/
  public function getNode($node){
  	return $this->nodes[$node];
  }
  /***************************************************************************************/
  public function addNode($node){
  	$this->nodes[] = $node; 
  }
  /***************************************************************************************/
  public function count(){
    return count($this->nodes);
  }
  /***************************************************************************************/
  public function __toString(){
    $outputStr = "";
    $outputStr .= "================================================\n";
    $outputStr .= "Root Node \n";
    $outputStr .= "================================================\n";  
    $outputStr .= $this->nodes[0]->getLine();
    $outputStr  .= $this->displayTree($this->nodes[0]) . "\n";

    return $outputStr; 
  }
  /***************************************************************************************/
  public function displayTree(GedcomRecordNode $start_node){
    // Frontier is the set of nodes adjacent to the current node 
    // that we haven't explored yet. We are going to explore the 
    // frontier in LIFO fashion. 
    $frontier = array($start_node);

    // We cannot set $last_fully_explored_node to NULL, because 
    // doing so will cause our test to determine whether to add nodes to the frontier
    // to produce a fatal error. Note, the parent of the dummy node is NULL. 
    $outputStr = "";

    while(!empty($frontier)){
      // In this version of depth first search, we want to pop the last node 
      // added off, instead of just peeking at it. 
      $top = array_pop($frontier);
      $outputStr .= "\n" . $top;

      // The following must be true for us to add elements to the frontier: 
      // 1. The top node has children to add to the frontier.
      if($top->hasChildren()){
        $frontier = array_merge($frontier, array_reverse($top->getChildren()));
      }
    }

    return $outputStr; 
  }
  /***************************************************************************************/
  public function isRoot($node){
    return $node->getParentIndex() === -1 && $node->getParentNode() instanceof NullGedcomRecordNode;
  }
  /***************************************************************************************/
  public function isValid(){
    return $this->valid; 
  }
  /***************************************************************************************/
  public function create(){
  	for($current_index = 0; $current_index < $this->sublist->getNumLines(); $current_index++){
      // Each node in our tree is a line from the sublist 
  		$current = new GedcomRecordNode($this->sublist->getLine($current_index), $current_index);

  		// Are we processing the root node?
  		if($current_index === 0)
  		{
        $current->setParent(new NullGedcomRecordNode()); 
        $current->setDepth(0); 
  		}
      else{
    		// Not processing the root node? Then we need to compare the level of the 
    		// current node with the level of the last node we processed to determine 
    		// the parent of the current node.   
    		$prev = $this->getNode($current_index-1);   // Get a reference to the last 
    		                                            // node seen. 

        // Just doing this to make the syntax less complicated in the test conditions
        $current_level = $current->getLine()->getLevel()->getValue();
        $currents_parent_level = ((int)$current_level)-1;
        $temp = $prev; 

        // We want to keep iterating until we reach the root node. 
        // The parent of the root node is an instance of NullGedcomRecordNode.
        // Only the parent of the root node is an instance of NullGedcomRecordNode,
        // so we can keep iterating until temp is an instance of NullGedcomRecordNode.
        // What happens if you get to the point where temp is an instance of 
        // NullGedcomNode? Well, then the level of the node is either negative
        // (which is invalid), or greater than all of the previous nodes which is 
        // also invalid. 
        while(!($temp instanceof NullGedcomRecordNode)){
          $temp_level = (int)$temp->getLine()->getLevel()->getValue();

          // If the level of temp is one less than the level of current, 
          // then temp is current's parent. We want to break out of the loop
          // now and not update temp. 
          if($temp_level === $currents_parent_level)
            break;

          // If you get here, that means that you did not 
          // find the parent. Go up the list to see if the 
          // next node is the parent. 
          $temp = $temp->getParent();
        }

        // If temp is an instance of NullGedcomRecord, then that means 
        // we've gone up the entire parent chain. If that is the case, 
        // then the line we're processing is invalid. 
        $this->valid = !($temp instanceof NullGedcomRecordNode);

        $current->setParent($temp);
        $current->setDepth($current->getParent()->getDepth() + 1);
        $current->getParent()->addChild($current);
      }

      $this->addNode($current);
  	}
  }

}