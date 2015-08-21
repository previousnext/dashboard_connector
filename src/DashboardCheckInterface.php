<?php

/**
 * @file
 * Contains DashboardCheckInterface.
 */

/**
 * Defines an interface for checking the status of a site.
 */
interface DashboardCheckInterface {

  /**
   * Checks the status and returns array of entries.
   *
   * @return \DashboardEntryInterface[]
   *   Array of entries.
   */
  public function check();

}
