OnDemandSendings
=====

### Considerations
>Install composer after clone the repository
```
$ composer install
```

>This project is now targeted to PHP 8.3.
```
Runtime extensions: sqlsrv, pdo_sqlsrv, soap
Test extensions: pdo_sqlite, sqlite3
```

>If your SQL Server client needs it, configure these env vars:
```
DB_ENCRYPT=no
DB_TRUST_SERVER_CERTIFICATE=yes
DB_LOGIN_TIMEOUT=5
```

>TDD runs on SQLite in memory, so tests do not need a SQL Server database.

### Test-driven development TDD
````
vendor/bin/phpunit
````

### Run Project
```
$ php artisan serve
```
Verify the deployment by navigating to your server address in your preferred browser.
```sh
127.0.0.1:8000
```
