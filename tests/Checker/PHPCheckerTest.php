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
     * Tests the php version check.
     */
    public function testPHPVersion() {
      $checks = array();

      // Pass PHP 5.5.
      $checker = new StubPHPChecker(50500, 1449705058);
      $checks = array_merge($checks, $checker->getChecks());

      // Fail PHP 5.4 because it's old.
      $checker = new StubPHPChecker(50400, 1449705058);
      $checks = array_merge($checks, $checker->getChecks());

      // Fail PHP 5.6 because it's the future.
      $checker = new StubPHPChecker(50600, 1504978442);
      $checks = array_merge($checks, $checker->getChecks());

      $this->assertNotEmpty($checks);

      $pass_check = $checks[0];
      $this->assertEquals($pass_check['name'], 'version');
      $this->assertEquals($pass_check['type'], 'php');
      $this->assertEquals($pass_check['alert_level'], 'notice');

      $fail_version_check = $checks[1];
      $this->assertEquals($fail_version_check['name'], 'version');
      $this->assertEquals($fail_version_check['type'], 'php');
      $this->assertEquals($fail_version_check['alert_level'], 'error');

      $fail_time_check = $checks[2];
      $this->assertEquals($fail_time_check['name'], 'version');
      $this->assertEquals($fail_time_check['type'], 'php');
      $this->assertEquals($fail_time_check['alert_level'], 'error');
    }
  }

  /**
   * Stubs calls to global functions for testing.
   */
  class StubPHPChecker extends PHPChecker {

    private $version = 0;
    private $time    = 0;

    /**
     * Constructor to set some vars to return.
     */
    public function __construct($version = 0, $time = 0) {
      $this->version = $version;
      $this->time    = $time;
    }

    /**
     * {@inheritdoc}
     */
    protected function getVersion() {
      return $this->version;
    }

    /**
     * {@inheritdoc}
     */
    protected function getTime() {
      return $this->time;
    }

    /**
     * {@inheritdoc}
     */
    protected function t($string, array $args = array(), array $options = array()) {
      return $string;
    }
  }
}
