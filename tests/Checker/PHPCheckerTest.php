<?php

/**
 * @file
 * Contains PNX\Dashboard\Checker\PHPCheckerTest
 */

namespace PNX\Dashboard\Tests\Checker {

  use PHPChecker;

  /**
   * Tests the performance checker plugin.
   */
  class PHPCheckerTest extends \PHPUnit_Framework_TestCase {

    /**
     * Tests the block cache check.
     */
    public function testPHPVersion() {
      $checker = new StubPHPChecker();

      $checks = $checker->getChecks();

      $this->assertNotEmpty($checks);

      $php_check = $checks[0];
      $this->assertEquals($php_check['name'], 'version');
      $this->assertEquals($php_check['type'], 'php');
      $this->assertEquals($php_check['alert_level'], 'notice');
      $this->assertEquals($php_check['description'], 'Running on PHP ' . PHP_VERSION . '.');
    }
  }

  /**
   * Stubs calls to global functions for testing.
   */
  class StubPHPChecker extends PHPChecker {

    /**
     * {@inheritdoc}
     */
    protected function t($string, array $args = array(), array $options = array()) {
      return strtr($string, $args);
    }
  }
}
