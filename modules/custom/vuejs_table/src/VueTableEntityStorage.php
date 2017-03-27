<?php

namespace Drupal\vuejs_table;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
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
class VueTableEntityStorage extends SqlContentEntityStorage implements VueTableEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(VueTableEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {vue_table_entity_revision} WHERE id=:id ORDER BY vid',
      array(':id' => $entity->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {vue_table_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      array(':uid' => $account->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(VueTableEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {vue_table_entity_field_revision} WHERE id = :id AND default_langcode = 1', array(':id' => $entity->id()))
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('vue_table_entity_revision')
      ->fields(array('langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED))
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
