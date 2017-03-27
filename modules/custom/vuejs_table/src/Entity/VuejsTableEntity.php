<?php

namespace Drupal\vuejs_table\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Vuejs table entity entity.
 *
 * @ConfigEntityType(
 *   id = "vuejs_table_entity",
 *   label = @Translation("Vuejs table entity"),
 *   handlers = {
 *     "list_builder" = "Drupal\vuejs_table\VuejsTableEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\vuejs_table\Form\VuejsTableEntityForm",
 *       "edit" = "Drupal\vuejs_table\Form\VuejsTableEntityForm",
 *       "delete" = "Drupal\vuejs_table\Form\VuejsTableEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\vuejs_table\VuejsTableEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "vuejs_table_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/vuejs_table_entity/{vuejs_table_entity}",
 *     "add-form" = "/admin/structure/vuejs_table_entity/add",
 *     "edit-form" = "/admin/structure/vuejs_table_entity/{vuejs_table_entity}/edit",
 *     "delete-form" = "/admin/structure/vuejs_table_entity/{vuejs_table_entity}/delete",
 *     "collection" = "/admin/structure/vuejs_table_entity"
 *   }
 * )
 */
class VuejsTableEntity extends ConfigEntityBase implements VuejsTableEntityInterface {

  /**
   * The Vuejs table entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Vuejs table entity label.
   *
   * @var string
   */
  protected $label;

}
