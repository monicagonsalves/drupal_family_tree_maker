<?php

namespace Drupal\family_tree_generator\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Family tree entities.
 */
class FamilyTreeViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['family_tree']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Family tree'),
      'help' => $this->t('The Family tree ID.'),
    );

    return $data;
  }

}
