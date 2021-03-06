<?php
namespace Drupal\family_tree_generator\Gedcom;

use Drupal\file\Entity\File;
use Drupal\family_tree_generator\Entity\Person;
use Drupal\family_tree_generator\Entity\Family;
use Drupal\family_tree_generator\Entity\ChildToFamily;
use Drupal\family_tree_generator\Entity\FamilyTree;
use Drupal\file\FileInterface;

class GedcomDrupalAdapter{
   // Class variables

   public static $processor; 
   public static $gedcom_records; 
   public static $child_to_family_links; 

	public static function process($form_input)
	{
	     $file = File::load($form_input);
       self::$child_to_family_links = array();
       self::$processor = new GedcomLineListProcessor($file->getFileUri());
       self::$gedcom_records = self::$processor->process();

       self::createPersonEntities();
       self::createFamilyEntities();

       $families = array();
       $people = array();
       $child_to_family_links = array();

       foreach(self::$gedcom_records["families"] as $id => $family)
         $families[] = $family["entity"]->id();

       foreach (self::$gedcom_records["people"] as $id => $person)
          $people[] = $person["entity"]->id();

        foreach (self::$child_to_family_links as $link) 
          $child_to_family_links[] = $link->id();

        $family_tree = FamilyTree::create(
          array(
            'families' => $families, 
            'persons' => $people, 
            'child_to_family' => $child_to_family_links
          )
        ); 

        $family_tree->save();
  }
  /*********************************************************************/
  public static function createPersonEntities()
  {
      foreach(self::$gedcom_records["people"] as $id => $person)
      {
        $person_entity_values = array(
          'first_name' => $person["first_name"],
          'last_name' => $person['last_name'],
          'name' => $person["name"],
          'xref_id' => $person["xref"]
        );

        if(array_key_exists('sex', $person))
          $person_entity_values['gender'] = $person['sex'];

        $person["entity"] = Person::create($person_entity_values);
        $person["entity"]->save();
        self::$gedcom_records["people"][$id]["entity"] = $person["entity"];
      }
  }
  /*********************************************************************/
  public static function createFamilyEntities()
  {

      foreach (self::$gedcom_records["families"] as $id => $family) 
      {

        $family_entity_values = array(
          'xref_id' => $family['xref_id'],
          'spouses' => array(
               self::$gedcom_records["people"][$family["husb"]]["entity"]->id(),
               self::$gedcom_records["people"][$family["wife"]]["entity"]->id()),
          'name' => self::$gedcom_records["people"][$family["husb"]]["name"] . " & "
                   . self::$gedcom_records["people"][$family["wife"]]["name"]
        );

        $family_entity_values["child"] = array();
        for($i = 0; $i < count($family["chil"]); $i++)
        {
          $child = $family["chil"][$i];
          $family_entity_values["child"][] = self::$gedcom_records["people"][$child]["entity"]->id();
        }


        $family["entity"] = Family::create($family_entity_values);
        $family["entity"]->save(); 

        //-------------------------------------------------------------------//
        // CREATE CHILD TO FAMILY ENTITY AS A LINK BETWEEN THE CHILDREN AND THE
        // FAMILY
        //-------------------------------------------------------------------//
        $child_to_family = ChildToFamily::create(array(
              'name' => $family_entity_values["name"],
              'family' => $family["entity"]->id()
          ));

        $child_to_family->save();
        self::$child_to_family_links[] = $child_to_family;

        for($i = 0; $i < count($family["chil"]); $i++)
        {
          $child = $family["chil"][$i];
          self::$gedcom_records["people"][$child]["entity"]->set('child_to_family',
            $child_to_family->id());
          
          self::$gedcom_records["people"][$child]["entity"]->save();
        }

        self::$gedcom_records["families"][$id]["entity"] = $family["entity"];

        //-------------------------------------------------------------------//
        // LINK THE SPOUSES
        //-------------------------------------------------------------------//
        self::$gedcom_records["people"][$family["husb"]]["entity"]->set("spouse_to_family", $family["entity"]->id());
        self::$gedcom_records["people"][$family["wife"]]["entity"]->set(
          "spouse_to_family", $family["entity"]->id());

        self::$gedcom_records["people"][$family["husb"]]["entity"]->save();
        self::$gedcom_records["people"][$family["wife"]]["entity"]->save();
      }
  }
}