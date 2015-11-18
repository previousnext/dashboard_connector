<?php

/**
 * @file
 * Contains ViewsChecker
 */

/**
 * Checks whether any views are in overridden state.
 */
class ViewsChecker implements CheckerInterface {

  /**
   * {@inheritdoc}
   */
  public function getChecks() {
    $checks = array();
    // Check whether any views are overridden.
    if (module_exists('views')) {
      $views = views_get_all_views();
      foreach ($views as $view) {
        if ($view->type == t('Overridden')) {
          $checks[] = array(
            'name'        => $view->name,
            'description' => t('View @name is overridden.', array('@name' => !empty($view->human_name) ? $view->human_name : $view->name)),
            'type'        => 'views',
            'alert_level' => 'warning',
          );
        }
      }
    }
    return $checks;
  }
}
