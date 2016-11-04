<?php

/**
 * @file
 * Contains child_to_family.page.inc.
 *
 * Page callback for Child to family entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Child to family templates.
 *
 * Default template: child_to_family.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_child_to_family(array &$variables) {
  // Fetch ChildToFamily Entity Object.
  $child_to_family = $variables['elements']['#child_to_family'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
