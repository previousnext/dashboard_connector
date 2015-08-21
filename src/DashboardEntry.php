<?php

/**
 * @file
 * Contains DashboardEntry.
 */

/**
 * Defines a class for tracking a dashboard entry.
 */
class DashboardEntry implements DashboardEntryInterface {

  protected $group;
  protected $alertLevel = DashboardEntryInterface::INFO;
  protected $displayName;
  protected $tags = array();
  protected $description = '';

  /**
   * {@inheritdoc}
   */
  public function getGroup() {
    return $this->group;
  }

  /**
   * {@inheritdoc}
   */
  public function getAlertLevel() {
    return $this->alertLevel;
  }

  /**
   * {@inheritdoc}
   */
  public function getDisplayName() {
    return $this->displayName;
  }

  /**
   * {@inheritdoc}
   */
  public function getTags() {
    return $this->tags;
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Factory method.
   *
   * @param array $values
   *   Values for entry.
   *
   * @return self
   *   New instance.
   */
  public static function create(array $values) {
    $required_keys = array(
      'group',
      'displayName',
    );
    if ($missing = array_diff($required_keys, array_keys($values))) {
      throw new \InvalidArgumentException(sprintf('Missing keys: %s', implode(', ', $missing)));
    }
    $entry = new static();
    foreach ($values as $key => $value) {
      $entry->{$key} = $value;
    }
    return $entry;
  }

  /**
   * Gets the object as json.
   *
   * @return string
   *   JSON representation.
   */
  public function asJson() {
    return json_encode(array(
      'alert_level' => $this->getAlertLevel(),
      'display_name' => $this->getDisplayName(),
      'description' => $this->getDescription(),
      'group' => $this->getGroup(),
      'tags' => $this->getTags(),
    ));
  }

}
