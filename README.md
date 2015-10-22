# PNX Dashboard Connector

This module provide a connector to the PNX Dashboard API to send module update
status information.

## Installation

The following modules are required:

* ctools
* service_container
* registry_autoload

In addition, the dashboard-lib PHP library needs to be available and registered
with an autoloader.

The easiest way to do that is to add a composer file to the root of your project
that contains the following:

```json
{
  "require": {
    "previousnext/dashboard-lib": "dev-master"
  },
  "repositories": [
    {
      "type": "vcs",
      "url":  "git@github.com:previousnext/dashboard-lib.git"
    }
  ]
}
```

Run `composer install`

Then add the following to your settings.php:

```php
require_once DRUPAL_ROOT . '/../vendor/autoload.php';
```

## Configuration

The module can be configured from `/admin/config/development/pnx-dashboard`

By default, the module is disabled for development environments to avoid posting
checks for dev sites.

The recommended approach is to set the `enabled` flag, `client_id` and `site_id`
via `settings.php`:

```php
// Dashboard settings.
$conf['dashboard_connector_client_id'] = 'local_dev';
$conf['dashboard_connector_site_id'] = 'local_dev';
$conf['dashboard_connector_enabled'] = TRUE;
```
