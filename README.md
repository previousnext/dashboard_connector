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
