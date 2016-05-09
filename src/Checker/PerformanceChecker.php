<?php

namespace Drupal\dashboard_connector\Checker;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\TranslationInterface;

/**
 * Checks whether various performance settings are enabled.
 */
class PerformanceChecker extends CheckerBase {

  /**
   * The Config Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * PerformanceChecker constructor.
   *
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The translations service.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(TranslationInterface $string_translation, ConfigFactoryInterface $config_factory) {
    parent::__construct($string_translation);
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = [];
    $config = $this->configFactory->get('system.performance');

    // Check the block cache.
    $blocks = $config->get('block_cache');
    if (empty($blocks)) {
      $checks[] = $this->buildCheck('performance', 'block_cache', $this->t('Cache blocks is disabled.'), 'warning');
    }

    // Check CSS aggregation.
    $aggregate = $config->get('preprocess_css');
    if (empty($aggregate)) {
      $checks[] = $this->buildCheck('performance', 'preprocess_css', $this->t('CSS aggregation and compression is disabled.'), 'warning');
    }

    // Check JS aggregation.
    $aggregate = $config->get('preprocess_js');
    if (empty($aggregate)) {
      $checks[] = $this->buildCheck('performance', 'preprocess_js', $this->t('JavaScript aggregation and compression is disabled.'), 'warning');
    }

    return $checks;
  }

}
