<?php

namespace Drupal\family_tree_generator\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Family entities.
 */
class FamilyViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['family']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Family'),
      'help' => $this->t('The Family ID.'),
    );

    return $data;
  }

}
