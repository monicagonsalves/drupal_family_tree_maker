<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens\TagTypes;

require_once("TagTypeFactory.php");

class TagType {             
	// Child tags that are allowed, but not necesarily missing 
	protected $specified_child_tags = NULL;
	protected $user_defined_tags = NULL;
	protected $rules; 
	protected $value; 
	protected $name; 
	protected $child_tags = array();
	protected $tag_type_factory; 

	protected const YEAR_PAT = "/[1-9]\d{0,3}/";
	protected const ANY_STR_PAT = "/.*/";
	protected const XREF_PAT = "/@[a-zA-Z0-9][^@\s]*@/";

	public function __construct($value, $name)
	{
		// For child tags
		$this->tag_type_factory = new TagTypeFactory();
		$this->user_defined_tags = array();
		$this->rules = array("pattern" => self::ANY_STR_PAT, 
			                 "can_be_null" => TRUE);
		$this->value = $value; 
		$this->name = $name; 
	}
	/******************************************************************/
	public function getChildTags(){
		return $this->child_tags;
	}
	/******************************************************************/
	public function validate()
	{
		// We are assuming the start node is this node
		$valid_children = TRUE; 
		foreach($this->child_tags as $child_tag){
			if($this->childTypeAllowed($child_tag)){
				$valid_children = $valid_children && $child_tag->validate();
			}
			else{
				$valid_children = FALSE;
				break;
			}
		}

		return $child_tag->validateValue() && $valid_children; 
	}
	/******************************************************************/
	public function validateValue()
	{
	    if($this->value == NULL)
	    	$valid = $this->value == NULL && $this->rules["can_be_null"];
	    else
	    	$valid = preg_match($this->rules["pattern"], $this->value);
	}
	/******************************************************************/
	public function childTypeAllowed($child_tag)
	{
		return in_array(strtolower($child_tag), $this->specified_child_tags);
	}
}