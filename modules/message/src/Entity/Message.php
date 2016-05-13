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
   * This method provides a way to define fields for an entity. Each field
   * corresponds to a field plugin available in Drupal.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    /**
     * This is the subject field. It uses a field type of "string" since it only
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

    /**
     * This is the message field. It uses a "long_string" as its field type since
     * it should be able to handle a long string of data.
     *
     * The field has a label and a description that are passed through Drupal´s
     * translation system.
     *
     * Display options are set for the field in form and view modes. These
     * options define how the field will be displayed when rendered as a form
     * and when rendered as content.
     */
    $fields['message'] = BaseFieldDefinition::create('string_long')
      ->setLabel(new TranslatableMarkup('Message'))
      ->setDescription(new TranslatableMarkup('The main content of the message.'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'string_textarea',
        'weight' => 0,
        'settings' => array(
          'rows' => 12,
        ),
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
        'weight' => 0,
        'label' => 'above',
      ]);

    /**
     * This field contains a reference to the user that sent the message.
     *
     * The field uses the "entity_reference" field as it's base since this
     * field allows us to connect various entities with each other.
     */
    $fields['sender_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(new TranslatableMarkup('Sender ID'))
      ->setDescription(new TranslatableMarkup('A reference to the user that sent the message.'))
      ->setSetting('target_type', 'user');

    /**
     * This field contains a reference to the user that recieved the message.
     *
     * The field uses the "entity_reference" field as it's base since this
     * field allows us to connect various entities with each other.
     */
    $fields['recipient_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(new TranslatableMarkup('Recipient ID'))
      ->setDescription(new TranslatableMarkup('A reference to the user that recieved the message.'))
      ->setSetting('target_type', 'user');

    return $fields;
  }
}
