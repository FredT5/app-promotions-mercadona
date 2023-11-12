# App Promotions Mercadona

Mercadona Promotions App is a web application to manage and display promotions on Mercadona products online

## Development environment

### Requirements

* PHP 8.1
* PostgreSQL
* Symfony CLI

You can check the requirements with the command (from the Symfony CLI):

```bash
symfony check:requirements
```

### Launch evelopment environment

```bash
symfony serve -d
```

### Display test data

```bash
symfony console doctrine:fixtures:load
```

### Launch test

```bash
php bin/phpunit --testdox
```

### Launch test coverage

```bash
php bin/phpunit --coverage-html var/log/test/test-coverage
```