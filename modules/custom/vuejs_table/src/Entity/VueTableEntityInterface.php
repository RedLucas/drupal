<?php

namespace Drupal\vuejs_table\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Vue table entity entities.
 *
 * @ingroup vuejs_table
 */
interface VueTableEntityInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Vue table entity name.
   *
   * @return string
   *   Name of the Vue table entity.
   */
  public function getName();

  /**
   * Sets the Vue table entity name.
   *
   * @param string $name
   *   The Vue table entity name.
   *
   * @return \Drupal\vuejs_table\Entity\VueTableEntityInterface
   *   The called Vue table entity entity.
   */
  public function setName($name);

  /**
   * Gets the Vue table entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Vue table entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Vue table entity creation timestamp.
   *
   * @param int $timestamp
   *   The Vue table entity creation timestamp.
   *
   * @return \Drupal\vuejs_table\Entity\VueTableEntityInterface
   *   The called Vue table entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Vue table entity published status indicator.
   *
   * Unpublished Vue table entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Vue table entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Vue table entity.
   *
   * @param bool $published
   *   TRUE to set this Vue table entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\vuejs_table\Entity\VueTableEntityInterface
   *   The called Vue table entity entity.
   */
  public function setPublished($published);

  /**
   * Gets the Vue table entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Vue table entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\vuejs_table\Entity\VueTableEntityInterface
   *   The called Vue table entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Vue table entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Vue table entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\vuejs_table\Entity\VueTableEntityInterface
   *   The called Vue table entity entity.
   */
  public function setRevisionUserId($uid);

}
