<?php

namespace Drupal\vuejs_table;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Vue table entity entity.
 *
 * @see \Drupal\vuejs_table\Entity\VueTableEntity.
 */
class VueTableEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\vuejs_table\Entity\VueTableEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished vue table entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published vue table entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit vue table entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete vue table entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add vue table entity entities');
  }

}
