<?php

namespace Drupal\family_tree_generator\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Family entities.
 *
 * @ingroup family_tree_generator
 */
interface FamilyInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Family name.
   *
   * @return string
   *   Name of the Family.
   */
  public function getName();

  /**
   * Sets the Family name.
   *
   * @param string $name
   *   The Family name.
   *
   * @return \Drupal\family_tree_generator\Entity\FamilyInterface
   *   The called Family entity.
   */
  public function setName($name);

  /**
   * Gets the Family creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Family.
   */
  public function getCreatedTime();

  /**
   * Sets the Family creation timestamp.
   *
   * @param int $timestamp
   *   The Family creation timestamp.
   *
   * @return \Drupal\family_tree_generator\Entity\FamilyInterface
   *   The called Family entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Family published status indicator.
   *
   * Unpublished Family are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Family is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Family.
   *
   * @param bool $published
   *   TRUE to set this Family to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\family_tree_generator\Entity\FamilyInterface
   *   The called Family entity.
   */
  public function setPublished($published);

}
