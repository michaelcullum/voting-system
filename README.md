PHP FIG Voting System
=====================

This is a system created for the PHP Framework Interoperability Group
to use for vote management.

Code Coverage: [![Code Coverage](https://scrutinizer-ci.com/g/michaelcullum/voting-system/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/michaelcullum/voting-system/?branch=master)

Code Quality Rating & Static Anaylsis: [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/michaelcullum/voting-system/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/michaelcullum/voting-system/?branch=master)

Build Status (Travis): [![Build Status](https://travis-ci.org/michaelcullum/voting-system.svg?branch=master)](https://travis-ci.org/michaelcullum/voting-system)

Installation
------------

1. Clone the repository
2. Create/modify `app/config/parameters.yml` as appropriate
3. Run `composer install`
4. Check everything is working by running tests `bin/phpunit`
5. Start a server by running `php bin/console server:run`
6. Create the database `bin/console doctrine:database:create`
7. Run migrations `bin/console doctrine:migrations:migrate --no-interaction`

Tests
-----

1. Run composer `composer install`
2. Run migrations `bin/console doctrine:migrations:migrate --no-interaction`
3. Run phpunit (test suite) `bin/phpunit`

Ensure after pulling changes you run database migrations with `bin/console doctrine:migrations:migrate --no-interaction`
