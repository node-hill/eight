<?php

namespace Drupal\message\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;

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

}
