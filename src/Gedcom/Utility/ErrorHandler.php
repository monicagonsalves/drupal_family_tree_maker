<?php 
namespace Drupal\family_tree_generator\Gedcom\Utility;

trait ErrorHandler{
	protected $errors = array();

	// Does the class have any errors? 
	public function hasErrors(){
		$this->findErrors();
		return count($this->errors) > 0; 
	}
	
	public function getErrors(){
		return $this->errors; 
	}
	abstract public function findErrors();

	// getErrors returns the list of errors, reportErrors on the other hand 
	// returns a string that you use to display the errors
	abstract public function reportErrors();
}
