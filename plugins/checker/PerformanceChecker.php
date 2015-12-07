<?php

/**
 * @file
 * Contains PerformanceChecker
 */

/**
 * Checks whether various performance settings are enabled.
 */
class PerformanceChecker implements CheckerInterface {

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = array();

    // Check the page cache.
    $cache = $this->getVariable('cache', 0);
    if (empty($cache)) {
      $checks[] = array(
        'name' => 'cache',
        'description' => $this->t('Cache pages for anonymous users is disabled.'),
        'type' => 'performance',
        'alert_level' => 'warning',
      );
    }

    // Check the block cache.
    $blocks = $this->getVariable('block_cache', 0);
    if (empty($blocks)) {
      $checks[] = array(
        'name' => 'block_cache',
        'description' => $this->t('Cache blocks is disabled.'),
        'type' => 'performance',
        'alert_level' => 'warning',
      );
    }

    // Check CSS aggregation.
    $aggregate = $this->getVariable('preprocess_css', 0);
    if (empty($aggregate)) {
      $checks[] = array(
        'name' => 'preprocess_css',
        'description' => $this->t('CSS aggregation and compression is disabled.'),
        'type' => 'performance',
        'alert_level' => 'warning',
      );
    }

    // Check JS aggregation.
    $aggregate = $this->getVariable('preprocess_js', 0);
    if (empty($aggregate)) {
      $checks[] = array(
        'name' => 'preprocess_js',
        'description' => $this->t('JavaScript aggregation and compression is disabled.'),
        'type' => 'performance',
        'alert_level' => 'warning',
      );
    }

    return $checks;
  }

  /**
   * Proxy for variable_get() to help unit testing.
   *
   * @param mixed $name
   *   The name of the variable to return.
   * @param mixed $default
   *   (optional) The default value to use if this variable has never been set.
   *
   * @return mixed
   *   The value of the variable.
   */
  protected function getVariable($name, $default = NULL) {
    return variable_get($name, $default);
  }

  /**
   * Proxy for t() to help unit testing.
   *
   * @param string $string
   *   A string containing the English string to translate.
   * @param array $args
   *   An associative array of replacements to make after translation.
   * @param array $options
   *   An associative array of additional options
   *
   * @return string
   *   The translated string.
   */
  protected function t($string, array $args = array(), array $options = array()) {
    // @codingStandardsIgnoreStart
    return t($string, $args, $options);
    // @codingStandardsIgnoreEnd
  }

}
