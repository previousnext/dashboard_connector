<?php
/**
 * @file
 * Plugin definition for status of paranoia.
 */

$plugin = array(
  'class info' => array(
    'class' => 'Paranoia',
    'file' => 'Paranoia.php',
  ),
  'class' => 'Paranoia',
);

/**
 * Defines a class for tracking if paranoia is enabled.
 */
class Paranoia implements DashboardCheckInterface {

 /**
  * {@inheritdoc}
  */
  public function check() {
    $entries = array();
    $exists = module_exists('paranoia');
    $entries[] = \DashboardEntry::create(array(
      'group' => 'Paranoia',
      'displayName' => 'Paranoia status',
      'alertLevel' => $exists ? DashboardEntryInterface::INFO : DashboardEntryInterface::ERROR,
      'description' => $exists ? t('Paranoia enabled') : t('Paranoia disabled'),
      'tags' => array('security', 'paranoia'),
    ));
    return $entries;
  }

}
