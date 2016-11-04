<?php 
namespace Drupal\family_tree_generator\Gedcom\Utility;

class Console{
	private static $ENDL = "\n";

	public static function out($str, $add_end_line = true){
		echo $str; 
		self::printEndline($add_end_line);
	}	

	public static function printBar($character, $length = 100){
		for($count = 0; $count < $length; $count++)
			echo $character; 
		self::printEndline(true);
	}

	public static function printEndline($add_end_line){
		if($add_end_line)
			echo self::$ENDL;
	}

	public static function printBoolean($boolean, $add_end_line = true){
		if($boolean === true)
			echo "True"; 
		else 
			echo "False";

		self::printEndline($add_end_line);
	}
}
