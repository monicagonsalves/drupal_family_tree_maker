<?php

namespace Drupal\family_tree_generator\Form;

use Drupal\family_tree_generator\Gedcom\GedcomDrupalAdapter;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\State\StateInterface;
use Drupal\Core\StreamWrapper\StreamWrapperManagerInterface;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\file\FileInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Form controller for Family tree edit forms.
 *
 * @ingroup family_tree_generator
 */
class FamilyTreeForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\family_tree_generator\Entity\FamilyTree */
    //$form = parent::buildForm($form, $form_state);
    //$entity = $this->entity;
    $form['gedcom_file'] = array(
    '#type' => 'managed_file',
    '#title' => t('Upload GEDCOM file'),
   // '#upload_location' => 'public://',
    '#name' => 'gedcom_file',
    '#description' => t('Upload GEDCOM file to generate family tree.'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('ged')
      ),
    );

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#description' => $this->t('Submit, #type = submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'FamilyTreeForm';
  }

  //**********************************************************************************//
  // Must override submitForm and validateForm because the functions on the parent
  // class attempt to create a FamilyTree entity from the form input values. For this 
  // to happen, there must be an input field for each form field, but we do not 
  // have that in our form at all!
  //**********************************************************************************//
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Remove button and internal Form API values from submitted values.
    $form_state->cleanValues();
    $values = $form_state->getValues();
    if (isset($values['gedcom_file']))  {
     // $file = File::load($values['gedcom_file'][0]);
      //$file_contents = file_get_contents($file->getFileUri());
      GedcomDrupalAdapter::process($values['gedcom_file'][0]);

      //dpm($file_contents);
    }
    else{
      
    }
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
  }

}
