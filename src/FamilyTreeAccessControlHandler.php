<?php

namespace Drupal\family_tree_generator;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Family tree entity.
 *
 * @see \Drupal\family_tree_generator\Entity\FamilyTree.
 */
class FamilyTreeAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\family_tree_generator\Entity\FamilyTreeInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished family tree entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published family tree entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit family tree entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete family tree entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add family tree entities');
  }

}
