<?php

/**
 * @file
 * Contains PNX\Dashboard\Checker\PerformanceCheckerTest
 */

namespace PNX\Dashboard\Tests\Checker {

  use PerformanceChecker;

  /**
   * Tests the performance checker plugin.
   */
  class PerformanceCheckerTest extends \PHPUnit_Framework_TestCase {

    /**
     * Tests the block cache check.
     */
    public function testBlockCache() {
      $checker = new StubPerformanceChecker();

      $checks = $checker->getChecks();

      $this->assertNotEmpty($checks);

      $cache_check = $checks[0];
      $this->assertEquals($cache_check['name'], 'cache');
      $this->assertEquals($cache_check['type'], 'performance');
      $this->assertEquals($cache_check['alert_level'], 'warning');

      $blocks_check = $checks[1];
      $this->assertEquals($blocks_check['name'], 'block_cache');
      $this->assertEquals($blocks_check['type'], 'performance');
      $this->assertEquals($blocks_check['alert_level'], 'warning');

      $preprocess_css_check = $checks[2];
      $this->assertEquals($preprocess_css_check['name'], 'preprocess_css');
      $this->assertEquals($preprocess_css_check['type'], 'performance');
      $this->assertEquals($preprocess_css_check['alert_level'], 'warning');

      $preprocess_js_check = $checks[3];
      $this->assertEquals($preprocess_js_check['name'], 'preprocess_js');
      $this->assertEquals($preprocess_js_check['type'], 'performance');
      $this->assertEquals($preprocess_js_check['alert_level'], 'warning');
    }
  }

  /**
   * Stubs calls to global functions for testing.
   */
  class StubPerformanceChecker extends PerformanceChecker {

    /**
     * {@inheritdoc}
     */
    protected function getVariable($name, $default = NULL) {
      return 0;
    }

    /**
     * {@inheritdoc}
     */
    protected function t($string, array $args = array(), array $options = array()) {
      return $string;
    }
  }
}
