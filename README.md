# PNX Dashboard Connector

This module provide a connector to the PNX Dashboard API to send module update
status information.

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
