<?php
/**
 * @file
 * Contains \Drupal\registration\Form\RegistrationForm.
 */
namespace Drupal\registration\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;


class RegistrationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'registration_form';
  }
  /**
   * {@inheritdoc}
   */
   
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name:'),
      '#required' => TRUE,
    );
    $form['phone'] = array (
      '#type' => 'tel',
      '#title' => t('Phone:'),
      '#required' => TRUE,
    );
    
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email:'),
      '#required' => TRUE,
    );
    $form['address'] = array(
      '#type' => 'textarea',
      '#title' => t('Mailing Address:'),
      '#required' => TRUE,
    );
    $form['price'] = array(
    '#type' => 'textfield',
    '#attributes' => array(
    ' type' => 'number', // insert space before attribute name :)
    ),
    '#title' => 'Ticket Price:',
    '#required' => TRUE,
    );
    
    $form['comment'] = array(
      '#type' => 'textarea',
      '#title' => t('Comment'),
      '#required' => TRUE,
    );
    
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
      '#validate' =>  array('security_settings_form_validate'),
    );

    return $form;
    
  }
  /**
   * {@inheritdoc}
   */
   
   
 public function submitForm(array &$form, FormStateInterface $form_state) {
    $conn = Database::getConnection();
    date_default_timezone_set('Asia/Calcutta'); 
    $date = date("Y-m-d h:i:s");
    $conn->insert('registration')->fields(
      array(
        'name' => $form_state->getValue('name'),
        'phone' => $form_state->getValue('phone'),
        'email' => $form_state->getValue('email'),
        'address' => $form_state->getValue('address'),
        'price' => $form_state->getValue('price'),
        'date' =>$date,
        'comment' => $form_state->getValue('comment'),
      )
    )->execute();
    //drupal_set_message("succesfully register");
    $url = Url::fromRoute('registration.article_list');
    $form_state->setRedirectUrl($url);
   }
 
  public function validateForm(array &$form, FormStateInterface $form_state) {
    //$email = $form_state->getValue('email_address');
 
  }
}