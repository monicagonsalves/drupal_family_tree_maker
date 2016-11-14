<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

use Drupal\family_tree_generator\Gedcom\Tokens\TagTypes\TagType; 

require_once("TagType.php");

class TAG_TYPE_NAME extends TagType {
	function __construct(){
		parent::__construct();

		$this->specified_child_tags = array(TAG_TYPE_LIST);
	}
}