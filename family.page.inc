<?php

/**
 * @file
 * Contains family.page.inc.
 *
 * Page callback for Family entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Family templates.
 *
 * Default template: family.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_family(array &$variables) {
  // Fetch Family Entity Object.
  $family = $variables['elements']['#family'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
