<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

require_once("TagTypeFactory.php");

class TagType {             
	protected $specified_child_tags = NULL;
	protected $user_defined_tags = NULL;
	protected $pattern = NULL; 
	protected $tag_type_factory; 

	public function __construct()
	{
		// For child tags
		$this->tag_type_factory = new TagTypeFactory();
		$this->user_defined_tags = array();
	}

	abstract public function validate();
}