#!/usr/bin/php
<?php
namespace Drupal\family_tree_generator\Gedcom\Utility;
require(getcwd() . "/Range.php");
require(getcwd() . "/Console.php");

// The command line arguments
var_dump($argv);
// Create a new Range object

function testRange($r){
	//$r->setRange($range);
	Console::printBar("*");
	Console::out("Range: " . $r->getRange());

	Console::out("Min is exclusive: ",false);
	Console::printBoolean($r->minIsExclusive());

	Console::out("Max is exclusive: ", false);
	Console::printBoolean($r->maxIsExclusive());

	Console::out("Min is infinite: ", false);
	Console::printBoolean($r->minIsInfinite());

	Console::out("Max is infinite: ", false);
	Console::printBoolean($r->maxIsInfinite());

	Console::out("10 in Range? ", false);
	Console::printBoolean($r->contains(10));

	Console::out("0 is in Range? ", false);
	Console::printBoolean($r->contains(0));

	Console::out("2 is in Range? ", false);
	Console::printBoolean($r->contains(2));

	Console::out("-1 is in Range? ", false);
	Console::printBoolean($r->contains(-1));

	Console::out("20 is in Range? ", false);
	Console::printBoolean($r->contains(20));

	Console::printBar("*");
}

testRange(new Range("[0,10]"));
testRange(new Range ("(0,10]"));
testRange(new Range("(0,10)"));
testRange(new Range("[0,10)"));
testRange(new Range("(-inf,10]"));
testRange(new Range("(-inf, 10)"));
testRange(new Range("[0,inf)"));
testRange(new Range("(0,inf)"));
?>