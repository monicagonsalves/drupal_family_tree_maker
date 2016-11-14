<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\Tag; 

require_once("../Tag.php");

class TAG_TYPE_NAME extends Tag {
	function __construct(){
		parent::__construct("TAG_TYPE_NAME");

		$this->specified_child_tags = array(TAG_TYPE_LIST);
	}
}