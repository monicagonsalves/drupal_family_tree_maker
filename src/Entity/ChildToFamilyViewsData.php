<?php

namespace Drupal\family_tree_generator\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Child to family entities.
 */
class ChildToFamilyViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['child_to_family']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Child to family'),
      'help' => $this->t('The Child to family ID.'),
    );

    return $data;
  }

}
