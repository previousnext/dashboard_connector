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

      $checker = new StubPHPChecker();
      $checks = array_merge($checks, $checker->getChecks());

      // Fail PHP 5.4 because it's old.
      $checker = new StubPHPCheckerFailVersion();
      $checks = array_merge($checks, $checker->getChecks());

      // Fail PHP 5.6 because it's the future.
      $checker = new StubPHPCheckerFailTime();
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

    /**
     * {@inheritdoc}
     */
    protected function getVersion() {
      return 50500;
    }

    /**
     * {@inheritdoc}
     */
    protected function getTime() {
      // 10 Dec 2015.
      return 1449705058;
    }

    /**
     * {@inheritdoc}
     */
    protected function t($string, array $args = array(), array $options = array()) {
      return $string;
    }
  }

  /**
   * Stubs calls for testing.
   */
  class StubPHPCheckerFailVersion extends StubPHPChecker {

    /**
     * {@inheritdoc}
     */
    protected function getVersion() {
      return 50400;
    }
  }

  /**
   * Stubs calls for testing.
   */
  class StubPHPCheckerFailTime extends StubPHPChecker {

    /**
     * {@inheritdoc}
     */
    protected function getVersion() {
      return 50600;
    }

    /**
     * {@inheritdoc}
     */
    protected function getTime() {
      // 10 Sep 2017.
      return 1504978442;
    }
  }
}
