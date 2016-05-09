<?php

namespace Drupal\Tests\dashboard_connector\Unit;

use Drupal\dashboard_connector\Checker\PerformanceChecker;
use Prophecy\Argument;

/**
 * Tests the performance checker plugin.
 */
class PerformanceCheckerTest extends \PHPUnit_Framework_TestCase {

  /**
   * The peformance checker.
   *
   * @var \Drupal\dashboard_connector\Checker\PerformanceChecker
   */
  protected $checker;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $config = $this->prophesize('Drupal\Core\Config\ImmutableConfig');
    $config->get(Argument::any())->willReturn([]);
    $config_factory = $this->prophesize('Drupal\Core\Config\ConfigFactoryInterface');
    $config_factory->get(Argument::any())->willReturn($config);
    $translation = $this->prophesize('Drupal\Core\StringTranslation\TranslationInterface');
    $this->checker = new PerformanceChecker($translation->reveal(), $config_factory->reveal());
  }

  /**
   * Tests the block cache check.
   */
  public function testBlockCache() {
    $checks = $this->checker->getChecks();

    $this->assertNotEmpty($checks);

    $blocks_check = $checks[0];
    $this->assertEquals($blocks_check['name'], 'block_cache');
    $this->assertEquals($blocks_check['type'], 'performance');
    $this->assertEquals($blocks_check['alert_level'], 'warning');

    $preprocess_css_check = $checks[1];
    $this->assertEquals($preprocess_css_check['name'], 'preprocess_css');
    $this->assertEquals($preprocess_css_check['type'], 'performance');
    $this->assertEquals($preprocess_css_check['alert_level'], 'warning');

    $preprocess_js_check = $checks[2];
    $this->assertEquals($preprocess_js_check['name'], 'preprocess_js');
    $this->assertEquals($preprocess_js_check['type'], 'performance');
    $this->assertEquals($preprocess_js_check['alert_level'], 'warning');
  }
}
