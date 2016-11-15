<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

require_once("TagTypeFactory.php");

class TagType {             
	// Child tags that are allowed, but not necesarily missing 
	protected $specified_child_tags = NULL;
	protected $user_defined_tags = NULL;
	protected $pattern = NULL; 
	protected $tag_type_factory; 

	public function __construct()
	{
		// For child tags
		$this->tag_type_factory = new TagTypeFactory();
		$this->user_defined_tags = array();
		$this->pattern = '/.*/';  // Any string, child classes are 
		                          // expected to replace this 
	}
	// validate pattern 
	// validate children
	abstract public function validate();
}