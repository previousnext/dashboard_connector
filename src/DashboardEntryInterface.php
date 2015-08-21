<?php

/**
 * @file
 * Contains DashboardEntryInterface.
 */

/**
 * Defines an interface for dashboard entries.
 */
interface DashboardEntryInterface {

  const ERROR = 'ERROR';
  const WARNING = 'WARNING';
  const INFO = 'INFO';

  /**
   * The group of the entry.
   *
   * @return string
   *   Group entry, e.g. 'update_status', 'queue_health'.
   */
  public function getGroup();

  /**
   * Gets the alert level.
   *
   * @return string
   *   Level e.g. ERROR, INFO.
   */
  public function getAlertLevel();

  /**
   * Gets the entry display name.
   *
   * @return string
   *   E.g. 'core', 'views.module'
   */
  public function getDisplayName();

  /**
   * Gets tags for the entry.
   *
   * @return string[]
   *   Array of tags.
   */
  public function getTags();

  /**
   * Gets the description.
   *
   * @return string
   *   Entry description. e.g. 'Core running 7.38, update to 7.39'
   */
  public function getDescription();

  /**
   * Gets the object as json.
   *
   * @return string
   *   JSON representation.
   */
  public function asJson();

}
