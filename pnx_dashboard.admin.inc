<?php

/**
 * @file
 * Admin forms for pnx_dashboard module.
 */

/**
 * Form API callback for the configuration form.
 */
function pnx_dashboard_admin() {
  $form = array(
    'pnx_dashboard_endpoint' => array(
      '#title' => t('Endpoint'),
      '#type' => 'textfield',
      '#default_value' => _pnx_dashboard_endpoint(),
    ),
  );
  return system_settings_form($form);
}
