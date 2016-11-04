<?php
namespace Drupal\family_tree_generator\Gedcom\Tokens;

class TagTypeFactory {
	public static function makeTagType($tag_name){
		$tag_name = strtolower($tag_name);

		if($tag_name === "name")
			return new Name();
		else if($tag_name === "fam")
			return new Fam();
		else if($tag_name === "famc")
			return new Famc();
		else if($tag_name === "fams")
			return new Fams();
		else if($tag_name === "husb")
			return new Husb();
		else if($tag_name === "indi")
			return new Indi();
		else if($tag_name === "nchil")
			return new Nchil();
		else if($tag_name === "sex")
			return new Sex();
		else if($tag_name === "wife")
			return new Wife();
		else if($tag_name === "chil")
			return new Chil();
	}
}