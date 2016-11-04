<?php
namespace Drupal\family_tree_generator\Gedcom;

use Drupal\file\Entity\File;
use Drupal\file\FileInterface;

class GedcomFile{
   // Class variables

   public static $parser; 
   public static $gedcom_records; 

	public static function process($form_input)
	{
	   $file = File::load($form_input);

       self::$parser = new Parser($file->getFileUri());

       $abstract_syntax_tree = self::$parser->parse();

       self::$gedcom_records = new GedcomRecordList($abstract_syntax_tree);

       self::$gedcom_records->create();

       dpm(self::$gedcom_records->length());
	}

}