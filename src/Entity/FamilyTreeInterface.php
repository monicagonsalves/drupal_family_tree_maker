<?php

namespace Drupal\family_tree_generator\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Family tree entities.
 *
 * @ingroup family_tree_generator
 */
interface FamilyTreeInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Family tree name.
   *
   * @return string
   *   Name of the Family tree.
   */
  public function getName();

  /**
   * Sets the Family tree name.
   *
   * @param string $name
   *   The Family tree name.
   *
   * @return \Drupal\family_tree_generator\Entity\FamilyTreeInterface
   *   The called Family tree entity.
   */
  public function setName($name);

  /**
   * Gets the Family tree creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Family tree.
   */
  public function getCreatedTime();

  /**
   * Sets the Family tree creation timestamp.
   *
   * @param int $timestamp
   *   The Family tree creation timestamp.
   *
   * @return \Drupal\family_tree_generator\Entity\FamilyTreeInterface
   *   The called Family tree entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Family tree published status indicator.
   *
   * Unpublished Family tree are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Family tree is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Family tree.
   *
   * @param bool $published
   *   TRUE to set this Family tree to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\family_tree_generator\Entity\FamilyTreeInterface
   *   The called Family tree entity.
   */
  public function setPublished($published);

}
