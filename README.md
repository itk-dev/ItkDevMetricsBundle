# ITK development Metrics bundle

This bundle is a wrapper for Symfony to make it a little easier to expose
metrics for Prometheus.

It has support for exporting Opcache and APCu metrics as well as custom
metrics for you application.

## Configuration

There are support for storing metrics information in 3 different storage
adaptors. The default recommendation is to use Redis as it's persistent
across reboots. So you will not miss any data if Prometheus scraper have
not collection data.

Default configuration:

```yaml
itkdev_metrics:
  # Prefix exported metrics (should be application name)
  namespace: ItkDevApp

  # Storage adapter to use
  adapter:
    type: redis # One of "apcu"; "memory"; "redis"

    # Connection options is only used by redis adapter
    options:
      host: 127.0.0.1
      port: 6379
      password: ~

  # Export metrics for these extensions
  extensions:
    opcache: false
    apcu: false
```

## Route

The bundle exposes the route `/metrics` which can be prefixed by creating a
route file under `config/routes` if the path is already in use.

```yaml
itkdev_metrics:
  prefix: '/custom/path/prefix'
  resource: '@ItkDevMetricsBundle/Resources/config/routes.xml'
```

## Service

The bundle comes with a single public service `MetricsService` that can be
used to collection custom metrics. It supports the standard metrics support
by Prometheus (counter, gauge, histogram). See the function documentation
about the different between them and how to use them.

For more information also see: [https://prometheus.io/docs/concepts/metric_types/](https://prometheus.io/docs/concepts/metric_types/)
