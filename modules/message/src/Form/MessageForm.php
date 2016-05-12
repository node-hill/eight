<?php 

namespace Drupal\message\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MessageForm extends FormBase {

  /**
   * Define a unique form id.
   */
  public function getFormId() {
    return 'message_send_form';
  }

  /**
   * Add elements to form array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    return $form;
  }

    /**
     * Do we need to validate the form data?
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      
    }

    /**
     * What should happen when form is submitted?
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

    }

}