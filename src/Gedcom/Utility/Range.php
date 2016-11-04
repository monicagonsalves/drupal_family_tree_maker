<?php
namespace Drupal\family_tree_generator\Gedcom\Utility;


class Range {
	private $min;
	private $max; 
	private $min_type;
	private $max_type;
	private $range; 

	// Valid input string patterns
	private $BOTH_MIN_MAX_EXCLUSIVE = "/\(\d+,\d+\)/";
	private $BOTH_MIN_MAX_INCLUSIVE = "/\[\d+,\d+\]/";
	private $MIN_EXCLUSIVE_ONLY = "/\(\d+,\d+\]/";
	private $MAX_EXCLUSIVE_ONLY = "/\[\d+,\d+\)/";
	private $MIN_INF_MAX_EXCL = "/\(-inf,\d+\)/";
	private $MIN_INF_MAX_INCL = "/\(-inf,\d+\]/";
	private $MIN_EXCL_MAX_INF = "/\(\d+,inf\)/";
	private $MIN_INCL_MAX_INF = "/\[\d+,inf\)/";

	// End types
	private $EXCL = 1;
	private $INCL = 2; 
	private $INF = 3; 

	public function __construct($range){
		// Remove any spaces from the range
		$this->updateAttributes($range);
	}

	public function contains($num){
		if($this->maxIsInclusive() && $this->minIsInclusive()){
			return $num >= $this->min && $num <= $this->max; 
		}
		else if($this->minIsExclusive() && $this->maxIsExclusive()){
			return $num > $this->min && $num < $this->max;
		}
		else if($this->minIsExclusive() && $this->maxIsInclusive()){
			return $num > $this->min && $num <= $this->max;
		}
		else if($this->minIsInclusive() && $this->maxIsExclusive()){
			return $num >= $this->min && $num < $this->max; 
		}
		else if($this->minIsInfinite() && $this->maxIsInclusive()){
			return $num <= $this->max; 
		}
		else if($this->minIsInfinite() && $this->maxIsExclusive()){
			return $num < $this->max;
		}
		else if($this->minIsInclusive() && $this->maxIsInfinite()){
			return $num >= $this->min; 
		}
		else if($this->minIsExclusive() && $this->maxIsInfinite()){
			return $num > $this->min;
		}
		else{
			return false; 
		}
	}

	public function setMinType(){
		if(preg_match($this->BOTH_MIN_MAX_EXCLUSIVE, $this->range) || 
		   preg_match($this->MIN_EXCLUSIVE_ONLY, $this->range) || 
		   preg_match($this->MIN_EXCL_MAX_INF, $this->range))
			$this->min_type = $this->EXCL;
		else if(strpos($this->range, "(-inf") !== false)
			$this->min_type = $this->INF; 
		else
			$this->min_type = $this->INCL; 
	}

	public function setMaxType(){
		if( preg_match($this->BOTH_MIN_MAX_EXCLUSIVE, $this->range) || 
		    preg_match($this->MAX_EXCLUSIVE_ONLY, $this->range) ||
		    preg_match($this->MIN_INF_MAX_EXCL, $this->range))
			$this->max_type = $this->EXCL;
		else if(strpos($this->range, "inf)") !== false)
			$this->max_type = $this->INF;
		else
			$this->max_type = $this->INCL;
		
	}


	public function getRange(){
		return $this->range; 
	}

	public function setRange($range){
		$this->range = $range; 
	}

	public function minIsExclusive(){
		return $this->min_type === $this->EXCL; 
	}

	public function maxIsExclusive(){
		return $this->max_type === $this->EXCL;  
	}

	public function minIsInclusive(){
		return $this->min_type === $this->INCL;
	}

	public function maxIsInclusive(){
		return $this->max_type === $this->INCL; 
	}

	public function minIsInfinite(){
		return $this->min_type === $this->INF;
	}

	public function maxIsInfinite(){
		return $this->max_type === $this->INF; 
	}


	private function getEnds(){
		$pattern = "(\[|\]|\(|\)|\s)"; // Replace brackets, parentheses, and spaces
		$replacement = "";            // Replace with empty string 

		return explode(",", preg_replace($pattern, $replacement, $this->range));
	}


	private function updateAttributes($range){
		$this->range = str_replace(" ", "", $range); 

		$ends = $this->getEnds();
		$this->min = $ends[0];
		$this->max = $ends[1];

		$this->setMinType();
		$this->setMaxType();		
	}
}