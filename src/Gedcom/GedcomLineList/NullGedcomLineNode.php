<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomLineList;

require_once("GedcomLineNode.php");

class NullGedcomLineNode extends GedcomLineNode{
  public function __construct(){
    parent::__construct(-1,-1);
  }
}