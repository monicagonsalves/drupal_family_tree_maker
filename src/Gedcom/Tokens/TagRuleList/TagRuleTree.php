<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagRuleList;


class TagRuleTree{
  private $nodes;

  public function __construct(){
  	$this->nodes = array();
  }
  /******************************************************************/
  public function addRule(TagRuleNode $rule){
  	$this->nodes[] = $rule; 
  }
  /******************************************************************/
  public function getRoot(){
  	return $this->nodes[0];
  }
  /******************************************************************/
  // Performs a post order traversal of a general tree
  public function traverse(TagRuleNode $rule){
    // First, visit all the child rules. 
    $children = $rule->getChildren();
    
    // Assume children are valid, and prove assumption false. 
    $valid_children = true;

    foreach($children as $child_rule)
      // The child nodes are valid only if ALL of them are valid. 
      $valid_children = $valid_children && $this->traverse($child_rule);

    // At this point you have visited all the descendent 
    // rules.
    return $rule->isValid() && $valid_children;
  }
  /******************************************************************/
  public function traverseIterative(TagRuleNode $start_rule){
    $this->resetColors();
    // Frontier is the set of nodes adjacent to the current node 
    // that we haven't explored yet. We are going to explore the 
    // frontier in LIFO fashion. 
    $frontier = array($start_rule);

    // We cannot set $last_fully_explored_node to NULL, because 
    // doing so will cause our test to determine whether to add nodes to the frontier
    // to produce a fatal error. Note, the parent of the dummy node is NULL. 
    $last_fully_explored_node = new TagRuleNode("Dummy"); 
    $isValid = true; 

    while(!empty($frontier)){
      // Peek at the last element added to the frontier. 
      $top_index = count($frontier) - 1; 
      $top = $frontier[$top_index];

      // The following must be true for us to add elements to the frontier: 
      // 1. The top node has children to add to the frontier
      // 2. Top cannot be the parent of the last fully explored node.
      if($top->hasChildren() && $last_fully_explored_node->getParent() != $top){
        $frontier = array_merge($frontier, $top->getChildren());
      }
      else{
        // If you are in this branch it means either $top is a leaf, 
        // or top is the parent of the last fully explored node. 
        $last_fully_explored_node = array_pop($frontier);
        $isValid = $isValid && $last_fully_explored_node->isValid();
      }
    }

    return $isValid; 
  }
  /******************************************************************/
  private function resetColors(){
    foreach($this->nodes as $rule)
      $rule->goWhite();
  }
}