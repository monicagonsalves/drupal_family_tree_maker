<?php

/**
 * @file
 * Contains family_tree.page.inc.
 *
 * Page callback for Family tree entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Family tree templates.
 *
 * Default template: family_tree.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_family_tree(array &$variables) {
  // Fetch FamilyTree Entity Object.
  $family_tree = $variables['elements']['#family_tree'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
