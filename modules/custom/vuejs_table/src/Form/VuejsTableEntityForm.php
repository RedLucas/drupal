<?php

namespace Drupal\vuejs_table\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class VuejsTableEntityForm.
 *
 * @package Drupal\vuejs_table\Form
 */
class VuejsTableEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $vuejs_table_entity = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $vuejs_table_entity->label(),
      '#description' => $this->t("Label for the Vuejs table entity."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $vuejs_table_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\vuejs_table\Entity\VuejsTableEntity::load',
      ],
      '#disabled' => !$vuejs_table_entity->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $vuejs_table_entity = $this->entity;
    $status = $vuejs_table_entity->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Vuejs table entity.', [
          '%label' => $vuejs_table_entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Vuejs table entity.', [
          '%label' => $vuejs_table_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($vuejs_table_entity->toUrl('collection'));
  }

}
