<?php

/**
 * @file
 * Contains AdminViewsChecker
 */

/**
 * Checks for a dangerous option in the admin_views user view.
 */
class AdminViewsChecker implements CheckerInterface {

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = array();
    // Check whether the admin_views user view still contains the delete action.
    if (module_exists('admin_views')) {
      $view = views_get_view('admin_views_user');
      $vbo_operations = $view->display['default']->display_options['fields']['views_bulk_operations']['vbo_operations'];

      if (!empty($vbo_operations['action::views_bulk_operations_delete_item']['selected'])) {
        $checks[] = array(
          'name'        => 'admin_views_user',
          'description' => t('This view exposes the dangerous user delete action.'),
          'type'        => 'views',
          'alert_level' => 'error',
        );
      }
    }
    return $checks;
  }
}
