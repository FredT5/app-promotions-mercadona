# App Promotions Mercadona

Mercadona Promotions App is a web application to manage and display promotions on Mercadona products online

## Development environment

### Pre-Requirements

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

### Fixtures

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

### CreatedAt and Slug Trait
```bash
use CreatedAtTrait;
use SlugTrait;
```

## Made with

Projet développé avec:

* [Symfony](https://symfony.com/) - Framework PHP Symfony

Bundle used for this project : 

- SecurityBundle [Documentation SecurityBundle] https://symfony.com/doc/current/security.html
- DoctrineFixturesBundle [Documentation DoctrineFixturesBundle](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html) 



