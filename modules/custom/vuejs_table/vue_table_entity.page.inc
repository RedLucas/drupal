<?php

/**
 * @file
 * Contains vue_table_entity.page.inc.
 *
 * Page callback for Vue table entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Vue table entity templates.
 *
 * Default template: vue_table_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_vue_table_entity(array &$variables) {
  // Fetch VueTableEntity Entity Object.
  $vue_table_entity = $variables['elements']['#vue_table_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
