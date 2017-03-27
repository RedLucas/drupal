<?php

namespace Drupal\vuejs_table\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Vue table entity entities.
 */
class VueTableEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
