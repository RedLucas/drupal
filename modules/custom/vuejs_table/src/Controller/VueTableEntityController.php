<?php

namespace Drupal\vuejs_table\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\vuejs_table\Entity\VueTableEntityInterface;

/**
 * Class VueTableEntityController.
 *
 *  Returns responses for Vue table entity routes.
 *
 * @package Drupal\vuejs_table\Controller
 */
class VueTableEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Vue table entity  revision.
   *
   * @param int $vue_table_entity_revision
   *   The Vue table entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($vue_table_entity_revision) {
    $vue_table_entity = $this->entityManager()->getStorage('vue_table_entity')->loadRevision($vue_table_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('vue_table_entity');

    return $view_builder->view($vue_table_entity);
  }

  /**
   * Page title callback for a Vue table entity  revision.
   *
   * @param int $vue_table_entity_revision
   *   The Vue table entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($vue_table_entity_revision) {
    $vue_table_entity = $this->entityManager()->getStorage('vue_table_entity')->loadRevision($vue_table_entity_revision);
    return $this->t('Revision of %title from %date', array('%title' => $vue_table_entity->label(), '%date' => format_date($vue_table_entity->getRevisionCreationTime())));
  }

  /**
   * Generates an overview table of older revisions of a Vue table entity .
   *
   * @param \Drupal\vuejs_table\Entity\VueTableEntityInterface $vue_table_entity
   *   A Vue table entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(VueTableEntityInterface $vue_table_entity) {
    $account = $this->currentUser();
    $langcode = $vue_table_entity->language()->getId();
    $langname = $vue_table_entity->language()->getName();
    $languages = $vue_table_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $vue_table_entity_storage = $this->entityManager()->getStorage('vue_table_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $vue_table_entity->label()]) : $this->t('Revisions for %title', ['%title' => $vue_table_entity->label()]);
    $header = array($this->t('Revision'), $this->t('Operations'));

    $revert_permission = (($account->hasPermission("revert all vue table entity revisions") || $account->hasPermission('administer vue table entity entities')));
    $delete_permission = (($account->hasPermission("delete all vue table entity revisions") || $account->hasPermission('administer vue table entity entities')));

    $rows = array();

    $vids = $vue_table_entity_storage->revisionIds($vue_table_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\vuejs_table\VueTableEntityInterface $revision */
      $revision = $vue_table_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->revision_timestamp->value, 'short');
        if ($vid != $vue_table_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.vue_table_entity.revision', ['vue_table_entity' => $vue_table_entity->id(), 'vue_table_entity_revision' => $vid]));
        }
        else {
          $link = $vue_table_entity->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->revision_log_message->value, '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.vue_table_entity.translation_revert', ['vue_table_entity' => $vue_table_entity->id(), 'vue_table_entity_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.vue_table_entity.revision_revert', ['vue_table_entity' => $vue_table_entity->id(), 'vue_table_entity_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.vue_table_entity.revision_delete', ['vue_table_entity' => $vue_table_entity->id(), 'vue_table_entity_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['vue_table_entity_revisions_table'] = array(
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    );

    return $build;
  }

}
