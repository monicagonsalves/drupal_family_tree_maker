<?php

namespace Drupal\family_tree_generator\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Child to family entities.
 *
 * @ingroup family_tree_generator
 */
interface ChildToFamilyInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Child to family name.
   *
   * @return string
   *   Name of the Child to family.
   */
  public function getName();

  /**
   * Sets the Child to family name.
   *
   * @param string $name
   *   The Child to family name.
   *
   * @return \Drupal\family_tree_generator\Entity\ChildToFamilyInterface
   *   The called Child to family entity.
   */
  public function setName($name);

  /**
   * Gets the Child to family creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Child to family.
   */
  public function getCreatedTime();

  /**
   * Sets the Child to family creation timestamp.
   *
   * @param int $timestamp
   *   The Child to family creation timestamp.
   *
   * @return \Drupal\family_tree_generator\Entity\ChildToFamilyInterface
   *   The called Child to family entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Child to family published status indicator.
   *
   * Unpublished Child to family are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Child to family is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Child to family.
   *
   * @param bool $published
   *   TRUE to set this Child to family to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\family_tree_generator\Entity\ChildToFamilyInterface
   *   The called Child to family entity.
   */
  public function setPublished($published);

}
