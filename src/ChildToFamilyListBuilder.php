<?php

namespace Drupal\family_tree_generator;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Child to family entities.
 *
 * @ingroup family_tree_generator
 */
class ChildToFamilyListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Child to family ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\family_tree_generator\Entity\ChildToFamily */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.child_to_family.edit_form', array(
          'child_to_family' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
