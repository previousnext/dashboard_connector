<?php

/**
 * @file
 * Contains Drupal\dashboard_connector\Form\SettingsForm.
 */

namespace Drupal\dashboard_connector\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;

/**
 * Class SettingsForm.
 *
 * @package Drupal\dashboard_connector\Form
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'dashboard_connector.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dashboard_connector_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('dashboard_connector.settings');
    $form['client_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Client ID'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('client_id'),
    );
    $form['site_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Site ID'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('site_id'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('dashboard_connector.settings')
      ->set('client_id', $form_state->getValue('client_id'))
      ->set('site_id', $form_state->getValue('site_id'))
      ->save();
  }

}
