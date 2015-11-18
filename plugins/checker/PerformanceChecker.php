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
    $cache = variable_get('cache', 0);
    if (empty($cache)) {
      $checks[] = array(
        'name'        => t('Page cache'),
        'description' => t('Cache pages for anonymous users is disabled.'),
        'type'        => 'performance',
        'alert_level' => 'warning',
      );
    }

    // Check CSS aggregation.
    $aggregate = variable_get('preprocess_css', 0);
    if (empty($aggregate)) {
      $checks[] = array(
        'name'        => t('Aggregate CSS'),
        'description' => t('CSS aggregation and compression is disabled.'),
        'type'        => 'performance',
        'alert_level' => 'warning',
      );
    }

    // Check JS aggregation.
    $aggregate = variable_get('preprocess_js', 0);
    if (empty($aggregate)) {
      $checks[] = array(
        'name'        => t('Aggregate JavaScript'),
        'description' => t('JavaScript aggregation and compression is disabled.'),
        'type'        => 'performance',
        'alert_level' => 'warning',
      );
    }

    return $checks;
  }
}
