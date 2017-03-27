<?php

namespace Drupal\vuejs_table;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\vuejs_table\Entity\VueTableEntityInterface;

/**
 * Defines the storage handler class for Vue table entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Vue table entity entities.
 *
 * @ingroup vuejs_table
 */
interface VueTableEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Vue table entity revision IDs for a specific Vue table entity.
   *
   * @param \Drupal\vuejs_table\Entity\VueTableEntityInterface $entity
   *   The Vue table entity entity.
   *
   * @return int[]
   *   Vue table entity revision IDs (in ascending order).
   */
  public function revisionIds(VueTableEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Vue table entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Vue table entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\vuejs_table\Entity\VueTableEntityInterface $entity
   *   The Vue table entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(VueTableEntityInterface $entity);

  /**
   * Unsets the language for all Vue table entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
