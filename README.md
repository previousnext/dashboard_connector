# PNX Dashboard Connector

This module provide a connector to the PNX Dashboard API to send module update
status information.

## Configuration

The module can be configured from `/admin/config/development/pnx-dashboard`

By default, the module is disabled for development environments to avoid posting
checks for dev sites.

The recommended approach is to set the `enabled` flag, `client_id`, `site_id` and `env` values
via `settings.php`:

```php
// Dashboard settings.
$conf['dashboard_connector_client_id'] = 'local_dev';
$conf['dashboard_connector_site_id'] = 'local_dev';
$conf['dashboard_connector_env'] = 'dev';
$conf['dashboard_connector_enabled'] = TRUE;
```

You can override alerts that you don't want reported as warnings or errors
by populating the `exclude_checks` array in `settings.php`:

```php
// Do not output warnings or errors for these checks.
$conf['dashboard_connector_exclude_checks'] = array(
  'module enabled' => array('paranoia', 'views_ui'),
  'performance'    => array('aggregate_css', 'aggregate_js'),
);
```

All exclusions are specified as `type => array(name, ...)`.
