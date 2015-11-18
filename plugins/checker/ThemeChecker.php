<?php

/**
 * @file
 * Contains ThemeChecker
 */

/**
 * Checks whether any views are in overridden state.
 */
class ThemeChecker implements CheckerInterface {

  /**
   * The current active theme.
   */
  private $theme = NULL;

  /**
   * The current active theme settings.
   */
  private $settings = array();

  /**
   * Constructor.
   */
  public function __construct() {
    $this->theme = variable_get('theme_default');
    $this->settings = variable_get('theme_' . $this->theme . '_settings', array());
  }

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = array();

    // The || should cause the more expensive base theme checking function to
    // not run if the current theme has this setting enabled.
    if ($this->checkTheme() || $this->checkBaseThemes()) {
      $checks[] = array(
        'name'        => $this->theme,
        'description' => t('The theme registry is being rebuilt on each request.'),
        'type'        => 'theme',
        'alert_level' => 'warning',
      );
    }

    return $checks;
  }

  /**
   * Check the theme settings.
   */
  private function checkTheme() {
    return !(empty($this->settings['rebuild_registry']) && empty($this->settings[$this->theme . '_rebuild_registry']));
  }

  /**
   * Check any base theme settings.
   */
  private function checkBaseThemes() {
    $themes = list_themes();
    $bases = array_keys(drupal_find_base_themes($themes, $this->theme));

    foreach ($bases as $base) {
      if (!empty($this->settings[$base . '_rebuild_registry'])) {
        return TRUE;
      }
    }
    return FALSE;
  }
}
