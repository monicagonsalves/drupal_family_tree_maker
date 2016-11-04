#!/usr/bin/php
<?php
namespace Drupal\family_tree_generator\Gedcom\GedcomLineList;

use Drupal\family_tree_generator\Gedcom\Utility\Console;
use Drupal\family_tree_generator\Gedcom\Tokens as Tokens;
use Drupal\family_tree_generator\Gedcom as Gedcom; 
use Drupal\family_tree_generator\Gedcom\Lexer; 
use Drupal\family_tree_generator\Gedcom\Parser; 


require_once("../Utility/Console.php");
require_once("../Tokens/lib.php");
require_once("GedcomLineNode.php");
require_once("GedcomLineList.php");
require_once("../Lexer.php");
require_once("../Parser.php");

$parser = new Parser("../test.ged");

$gedcom_line_list = $parser->lex();

Console::out("The number of elements in the list: " . $gedcom_line_list->getNumLines());

// Let's see what each line says 
$line_indices = array(0,54,58,53,56,682);
foreach($line_indices as $index){
	Console::printBar("-", 50);
	Console::out("Line #" . $index);
	Console::printBar("-",50);

	Console::out($gedcom_line_list->getLine($index));
}

Console::printBar("*",50);
Console::out("TESTING PARTITION");
Console::printBar("*",50);

$gedcom_line_list->partition();

Console::out("Number of partition points is: " . $gedcom_line_list->getNumSublists());

// Now we're going to test if we're really peeling off sublists
$gedcom_line_list->getAllSublists();
?>