#!/usr/bin/php
<?php
namespace Drupal\family_tree_generator\Gedcom;

use Drupal\family_tree_generator\Gedcom\Utility\Console;


require_once("Utility/Console.php");
require_once("Parser.php");

$parser = new Parser("test.ged");

$parser->parse();
?>