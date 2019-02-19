<?php

namespace Drupal\Tests\dashboard_connector\Kernel;

use Drupal\Tests\token\Kernel\KernelTestBase;

/**
 * @coversDefaultClass \Drupal\dashboard_connector\Checker\CoreExtensionChecker
 * @group dashboard_connector
 */
class CoreExtensionCheckerKernelTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['node', 'comment', 'dashboard_connector'];

  /**
   * @covers ::getChecks
   */
  public function testCoreExtensions() {
    /** @var \Drupal\dashboard_connector\Checker\CheckerInterface $coreChecker */
    $coreChecker = \Drupal::service('dashboard.checker.core_extension');

    $checks = $coreChecker->getChecks();

    $this->assertNotEmpty($checks);

    $check = $checks[0];
    $this->assertEquals($check['type'], 'core_module');
    $this->assertEquals($check['name'], 'path');
    $this->assertEquals($check['description'], 'Enabled module');
    $this->assertEquals($check['alert_level'], 'notice');

  }

}
