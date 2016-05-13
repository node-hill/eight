<?php

namespace Drupal\message\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * @ContentEntityType(
 *   id = "message_message",
 *   label = @Translation("Message"),
 *   base_table = "message_messages",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "subject"
 *   },
 * )
 */
class Message extends ContentEntityBase implements ContentEntityInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    /**
     * This is the subject field. It has a data type of "string" since it only
     * needs to handle a limited length of data.
     *
     * The subject field has a label and a description that are both passed
     * through Drupal's translation system to allow translation.
     *
     * The field is set to required since a subject must be defined to create
     * a new message.
     *
     * The field has a default "max_length" of 255 since this is the maximum
     * allowed length of a string field in SQL.
     *
     * The field has display options set for the form render mode so that it
     * will use a textfield when rendered.
     */
    $fields['subject'] = BaseFieldDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Subject'))
      ->setDescription(new TranslatableMarkup('The subject of the message.'))
      ->setRequired(TRUE)
      ->setSettings([
        'max_length' => 255,
      ])
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
      ));

    return $fields;
  }
}
