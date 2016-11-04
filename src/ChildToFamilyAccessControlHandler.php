<?php

namespace Drupal\family_tree_generator;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Child to family entity.
 *
 * @see \Drupal\family_tree_generator\Entity\ChildToFamily.
 */
class ChildToFamilyAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\family_tree_generator\Entity\ChildToFamilyInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished child to family entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published child to family entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit child to family entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete child to family entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add child to family entities');
  }

}
