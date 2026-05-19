<?php

use Illuminate\Support\Str;
use Pdo\Mysql;

$normalizeEnvString = static function (mixed $value): string {
    if (! is_string($value)) {
        return '';
    }

    return trim($value, " \t\n\r\0\x0B\"'");
};

$dbUrl = $normalizeEnvString(env('DB_URL', ''));
$dbHost = $normalizeEnvString(env('DB_HOST', '127.0.0.1'));
$dbPort = $normalizeEnvString(env('DB_PORT', '3306'));
$dbDatabase = $normalizeEnvString(env('DB_DATABASE', 'laravel'));
$dbUsername = $normalizeEnvString(env('DB_USERNAME', 'root'));
$dbPassword = $normalizeEnvString(env('DB_PASSWORD', ''));
$dbSocket = $normalizeEnvString(env('DB_SOCKET', ''));

$redisUrl = $normalizeEnvString(env('REDIS_URL', ''));
$redisHost = $normalizeEnvString(env('REDIS_HOST', '127.0.0.1'));
$redisPassword = $normalizeEnvString(env('REDIS_PASSWORD', ''));

if (strtolower($redisPassword) === 'null') {
    $redisPassword = '';
}

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => $dbUrl !== '' ? $dbUrl : null,
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
            'transaction_mode' => 'DEFERRED',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => $dbUrl !== '' ? $dbUrl : null,
            'host' => $dbHost !== '' ? $dbHost : '127.0.0.1',
            'port' => $dbPort !== '' ? $dbPort : '3306',
            'database' => $dbDatabase !== '' ? $dbDatabase : 'laravel',
            'username' => $dbUsername !== '' ? $dbUsername : 'root',
            'password' => $dbPassword,
            'unix_socket' => $dbSocket,
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                Mysql::ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'mariadb' => [
            'driver' => 'mariadb',
            'url' => $dbUrl !== '' ? $dbUrl : null,
            'host' => $dbHost !== '' ? $dbHost : '127.0.0.1',
            'port' => $dbPort !== '' ? $dbPort : '3306',
            'database' => $dbDatabase !== '' ? $dbDatabase : 'laravel',
            'username' => $dbUsername !== '' ? $dbUsername : 'root',
            'password' => $dbPassword,
            'unix_socket' => $dbSocket,
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                Mysql::ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => $dbUrl !== '' ? $dbUrl : null,
            'host' => $dbHost !== '' ? $dbHost : '127.0.0.1',
            'port' => $dbPort !== '' ? $dbPort : '5432',
            'database' => $dbDatabase !== '' ? $dbDatabase : 'laravel',
            'username' => $dbUsername !== '' ? $dbUsername : 'root',
            'password' => $dbPassword,
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => env('DB_SSLMODE', 'prefer'),
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => $dbUrl !== '' ? $dbUrl : null,
            'host' => $dbHost !== '' ? $dbHost : 'localhost',
            'port' => $dbPort !== '' ? $dbPort : '1433',
            'database' => $dbDatabase !== '' ? $dbDatabase : 'laravel',
            'username' => $dbUsername !== '' ? $dbUsername : 'root',
            'password' => $dbPassword,
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-database-'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],

        'default' => [
            'url' => $redisUrl !== '' ? $redisUrl : null,
            'host' => $redisHost !== '' ? $redisHost : '127.0.0.1',
            'username' => env('REDIS_USERNAME'),
            'password' => $redisPassword !== '' ? $redisPassword : null,
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

        'cache' => [
            'url' => $redisUrl !== '' ? $redisUrl : null,
            'host' => $redisHost !== '' ? $redisHost : '127.0.0.1',
            'username' => env('REDIS_USERNAME'),
            'password' => $redisPassword !== '' ? $redisPassword : null,
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

    ],

];
