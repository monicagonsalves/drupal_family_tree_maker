<?php

namespace Drupal\family_tree_generator\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Person entities.
 */
class PersonViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['person']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Person'),
      'help' => $this->t('The Person ID.'),
    );

    return $data;
  }

}
