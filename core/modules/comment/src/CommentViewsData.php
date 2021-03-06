<?php

namespace Drupal\comment;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\views\EntityViewsData;

/**
 * Provides views data for the comment entity type.
 */
class CommentViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['comment_field_data']['table']['base']['help'] = $this->t('Comments are responses to content.');
    $data['comment_field_data']['table']['base']['access query tag'] = 'comment_access';

    $data['comment_field_data']['table']['wizard_id'] = 'comment';

    $data['comment_field_data']['subject']['title'] = $this->t('Title');
    $data['comment_field_data']['subject']['help'] = $this->t('The title of the comment.');

    $data['comment_field_data']['name']['title'] = $this->t('Author');
    $data['comment_field_data']['name']['help'] = $this->t("The name of the comment's author. Can be rendered as a link to the author's homepage.");
    $data['comment_field_data']['name']['field']['default_formatter'] = 'comment_username';

    $data['comment_field_data']['homepage']['title'] = $this->t("Author's website");
    $data['comment_field_data']['homepage']['help'] = $this->t("The website address of the comment's author. Can be rendered as a link. Will be empty if the author is a registered user.");

    $data['comment_field_data']['mail']['help'] = $this->t('Email of user that posted the comment. Will be empty if the author is a registered user.');

    $data['comment_field_data']['created']['title'] = $this->t('Post date');
    $data['comment_field_data']['created']['help'] = $this->t('Date and time of when the comment was created.');

    $data['comment_field_data']['created_fulldata'] = array(
      'title' => $this->t('Created date'),
      'help' => $this->t('Date in the form of CCYYMMDD.'),
      'argument' => array(
        'field' => 'created',
        'id' => 'date_fulldate',
      ),
    );

    $data['comment_field_data']['created_year_month'] = array(
      'title' => $this->t('Created year + month'),
      'help' => $this->t('Date in the form of YYYYMM.'),
      'argument' => array(
        'field' => 'created',
        'id' => 'date_year_month',
      ),
    );

    $data['comment_field_data']['created_year'] = array(
      'title' => $this->t('Created year'),
      'help' => $this->t('Date in the form of YYYY.'),
      'argument' => array(
        'field' => 'created',
        'id' => 'date_year',
      ),
    );

    $data['comment_field_data']['created_month'] = array(
      'title' => $this->t('Created month'),
      'help' => $this->t('Date in the form of MM (01 - 12).'),
      'argument' => array(
        'field' => 'created',
        'id' => 'date_month',
      ),
    );

    $data['comment_field_data']['created_day'] = array(
      'title' => $this->t('Created day'),
      'help' => $this->t('Date in the form of DD (01 - 31).'),
      'argument' => array(
        'field' => 'created',
        'id' => 'date_day',
      ),
    );

    $data['comment_field_data']['created_week'] = array(
      'title' => $this->t('Created week'),
      'help' => $this->t('Date in the form of WW (01 - 53).'),
      'argument' => array(
        'field' => 'created',
        'id' => 'date_week',
      ),
    );

    $data['comment_field_data']['changed']['title'] = $this->t('Updated date');
    $data['comment_field_data']['changed']['help'] = $this->t('Date and time of when the comment was last updated.');

    $data['comment_field_data']['changed_fulldata'] = array(
      'title' => $this->t('Changed date'),
      'help' => $this->t('Date in the form of CCYYMMDD.'),
      'argument' => array(
        'field' => 'changed',
        'id' => 'date_fulldate',
      ),
    );

    $data['comment_field_data']['changed_year_month'] = array(
      'title' => $this->t('Changed year + month'),
      'help' => $this->t('Date in the form of YYYYMM.'),
      'argument' => array(
        'field' => 'changed',
        'id' => 'date_year_month',
      ),
    );

    $data['comment_field_data']['changed_year'] = array(
      'title' => $this->t('Changed year'),
      'help' => $this->t('Date in the form of YYYY.'),
      'argument' => array(
        'field' => 'changed',
        'id' => 'date_year',
      ),
    );

    $data['comment_field_data']['changed_month'] = array(
      'title' => $this->t('Changed month'),
      'help' => $this->t('Date in the form of MM (01 - 12).'),
      'argument' => array(
        'field' => 'changed',
        'id' => 'date_month',
      ),
    );

    $data['comment_field_data']['changed_day'] = array(
      'title' => $this->t('Changed day'),
      'help' => $this->t('Date in the form of DD (01 - 31).'),
      'argument' => array(
        'field' => 'changed',
        'id' => 'date_day',
      ),
    );

    $data['comment_field_data']['changed_week'] = array(
      'title' => $this->t('Changed week'),
      'help' => $this->t('Date in the form of WW (01 - 53).'),
      'argument' => array(
        'field' => 'changed',
        'id' => 'date_week',
      ),
    );

    $data['comment_field_data']['status']['title'] = $this->t('Approved status');
    $data['comment_field_data']['status']['help'] = $this->t('Whether the comment is approved (or still in the moderation queue).');
    $data['comment_field_data']['status']['filter']['label'] = $this->t('Approved comment status');
    $data['comment_field_data']['status']['filter']['type'] = 'yes-no';

    $data['comment']['approve_comment'] = array(
      'field' => array(
        'title' => $this->t('Link to approve comment'),
        'help' => $this->t('Provide a simple link to approve the comment.'),
        'id' => 'comment_link_approve',
      ),
    );

    $data['comment']['replyto_comment'] = array(
      'field' => array(
        'title' => $this->t('Link to reply-to comment'),
        'help' => $this->t('Provide a simple link to reply to the comment.'),
        'id' => 'comment_link_reply',
      ),
    );

    $data['comment_field_data']['thread']['field'] = array(
      'title' => $this->t('Depth'),
      'help' => $this->t('Display the depth of the comment if it is threaded.'),
      'id' => 'comment_depth',
    );
    $data['comment_field_data']['thread']['sort'] = array(
      'title' => $this->t('Thread'),
      'help' => $this->t('Sort by the threaded order. This will keep child comments together with their parents.'),
      'id' => 'comment_thread',
    );
    unset($data['comment_field_data']['thread']['filter']);
    unset($data['comment_field_data']['thread']['argument']);

    $entities_types = \Drupal::entityManager()->getDefinitions();

    // Provide a relationship for each entity type except comment.
    foreach ($entities_types as $type => $entity_type) {
      if ($type == 'comment' || !$entity_type->entityClassImplements(ContentEntityInterface::class) || !$entity_type->getBaseTable()) {
        continue;
      }
      if ($fields = \Drupal::service('comment.manager')->getFields($type)) {
        $data['comment_field_data'][$type] = array(
          'relationship' => array(
            'title' => $entity_type->getLabel(),
            'help' => $this->t('The @entity_type to which the comment is a reply to.', array('@entity_type' => $entity_type->getLabel())),
            'base' => $entity_type->getDataTable() ?: $entity_type->getBaseTable(),
            'base field' => $entity_type->getKey('id'),
            'relationship field' => 'entity_id',
            'id' => 'standard',
            'label' => $entity_type->getLabel(),
            'extra' => array(
              array(
                'field' => 'entity_type',
                'value' => $type,
                'table' => 'comment_field_data'
              ),
            ),
          ),
        );
      }
    }

    $data['comment_field_data']['uid']['title'] = $this->t('Author uid');
    $data['comment_field_data']['uid']['help'] = $this->t('If you need more fields than the uid add the comment: author relationship');
    $data['comment_field_data']['uid']['relationship']['title'] = $this->t('Author');
    $data['comment_field_data']['uid']['relationship']['help'] = $this->t("The User ID of the comment's author.");
    $data['comment_field_data']['uid']['relationship']['label'] = $this->t('author');

    $data['comment_field_data']['pid']['title'] = $this->t('Parent CID');
    $data['comment_field_data']['pid']['relationship']['title'] = $this->t('Parent comment');
    $data['comment_field_data']['pid']['relationship']['help'] = $this->t('The parent comment');
    $data['comment_field_data']['pid']['relationship']['label'] = $this->t('parent');

    // Define the base group of this table. Fields that don't have a group defined
    // will go into this field by default.
    $data['comment_entity_statistics']['table']['group']  = $this->t('Comment Statistics');

    // Provide a relationship for each entity type except comment.
    foreach ($entities_types as $type => $entity_type) {
      if ($type == 'comment' || !$entity_type->entityClassImplements(ContentEntityInterface::class) || !$entity_type->getBaseTable()) {
        continue;
      }
      // This relationship does not use the 'field id' column, if the entity has
      // multiple comment-fields, then this might introduce duplicates, in which
      // case the site-builder should enable aggregation and SUM the comment_count
      // field. We cannot create a relationship from the base table to
      // {comment_entity_statistics} for each field as multiple joins between
      // the same two tables is not supported.
      if (\Drupal::service('comment.manager')->getFields($type)) {
        $data['comment_entity_statistics']['table']['join'][$entity_type->getDataTable() ?: $entity_type->getBaseTable()] = array(
          'type' => 'INNER',
          'left_field' => $entity_type->getKey('id'),
          'field' => 'entity_id',
          'extra' => array(
            array(
              'field' => 'entity_type',
              'value' => $type,
            ),
          ),
        );
      }
    }

    $data['comment_entity_statistics']['last_comment_timestamp'] = array(
      'title' => $this->t('Last comment time'),
      'help' => $this->t('Date and time of when the last comment was posted.'),
      'field' => array(
        'id' => 'comment_last_timestamp',
      ),
      'sort' => array(
        'id' => 'date',
      ),
      'filter' => array(
        'id' => 'date',
      ),
    );

    $data['comment_entity_statistics']['last_comment_name'] = array(
      'title' => $this->t("Last comment author"),
      'help' => $this->t('The name of the author of the last posted comment.'),
      'field' => array(
        'id' => 'comment_ces_last_comment_name',
        'no group by' => TRUE,
      ),
      'sort' => array(
        'id' => 'comment_ces_last_comment_name',
        'no group by' => TRUE,
      ),
    );

    $data['comment_entity_statistics']['comment_count'] = array(
      'title' => $this->t('Comment count'),
      'help' => $this->t('The number of comments an entity has.'),
      'field' => array(
        'id' => 'numeric',
      ),
      'filter' => array(
        'id' => 'numeric',
      ),
      'sort' => array(
        'id' => 'standard',
      ),
      'argument' => array(
        'id' => 'standard',
      ),
    );

    $data['comment_entity_statistics']['last_updated'] = array(
      'title' => $this->t('Updated/commented date'),
      'help' => $this->t('The most recent of last comment posted or entity updated time.'),
      'field' => array(
        'id' => 'comment_ces_last_updated',
        'no group by' => TRUE,
      ),
      'sort' => array(
        'id' => 'comment_ces_last_updated',
        'no group by' => TRUE,
      ),
      'filter' => array(
        'id' => 'comment_ces_last_updated',
      ),
    );

    $data['comment_entity_statistics']['cid'] = array(
      'title' => $this->t('Last comment CID'),
      'help' => $this->t('Display the last comment of an entity'),
      'relationship' => array(
        'title' => $this->t('Last comment'),
        'help' => $this->t('The last comment of an entity.'),
        'group' => $this->t('Comment'),
        'base' => 'comment',
        'base field' => 'cid',
        'id' => 'standard',
        'label' => $this->t('Last Comment'),
      ),
    );

    $data['comment_entity_statistics']['last_comment_uid'] = array(
      'title' => $this->t('Last comment uid'),
      'help' => $this->t('The User ID of the author of the last comment of an entity.'),
      'relationship' => array(
        'title' => $this->t('Last comment author'),
        'base' => 'users',
        'base field' => 'uid',
        'id' => 'standard',
        'label' => $this->t('Last comment author'),
      ),
      'filter' => array(
        'id' => 'numeric',
      ),
      'argument' => array(
        'id' => 'numeric',
      ),
      'field' => array(
        'id' => 'numeric',
      ),
    );

    $data['comment_entity_statistics']['entity_type'] = array(
      'title' => $this->t('Entity type'),
      'help' => $this->t('The entity type to which the comment is a reply to.'),
      'field' => array(
        'id' => 'standard',
      ),
      'filter' => array(
        'id' => 'string',
      ),
      'argument' => array(
        'id' => 'string',
      ),
      'sort' => array(
        'id' => 'standard',
      ),
    );
    $data['comment_entity_statistics']['field_name'] = array(
      'title' => $this->t('Comment field name'),
      'help' => $this->t('The field name from which the comment originated.'),
      'field' => array(
        'id' => 'standard',
      ),
      'filter' => array(
        'id' => 'string',
      ),
      'argument' => array(
        'id' => 'string',
      ),
      'sort' => array(
        'id' => 'standard',
      ),
    );

    return $data;
  }

}
