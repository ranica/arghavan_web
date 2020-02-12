<?php return array (
  'app' =>
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost:8000',
    'timezone' => env('APP_TIMEZONE', 'Asia/Tehran'),
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:+dJLeN2dkTK3IgQoWPW9yo1f672AEfjvIr10//0oDbI=',
    'cipher' => 'AES-256-CBC',
    'log' => 'single',
    'log_level' => 'debug',
    'providers' =>
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Morilog\\Jalali\\JalaliServiceProvider',
      27 => 'Intervention\\Image\\ImageServiceProvider',
      28 => 'phplusir\\smsir\\SmsirServiceProvider',
      29 => 'Elibyy\\TCPDF\\ServiceProvider',
    ),
    'aliases' =>
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'jDate' => 'Morilog\\Jalali\\Facades\\jDate',
      'jDateTime' => 'Morilog\\Jalali\\Facades\\jDateTime',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Smsir' => 'phplusir\\smsir\\SmsirFacade',
      'PDF' => 'Elibyy\\TCPDF\\Facades\\TCPDF',
    ),
  ),
  'auth' =>
  array (
    'defaults' =>
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' =>
    array (
      'web' =>
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' =>
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
    ),
    'providers' =>
    array (
      'users' =>
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' =>
    array (
      'users' =>
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' =>
  array (
    'default' => 'log',
    'connections' =>
    array (
      'pusher' =>
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' =>
        array (
        ),
      ),
      'redis' =>
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' =>
      array (
        'driver' => 'log',
      ),
      'null' =>
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' =>
  array (
    'default' => 'file',
    'stores' =>
    array (
      'apc' =>
      array (
        'driver' => 'apc',
      ),
      'array' =>
      array (
        'driver' => 'array',
      ),
      'database' =>
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' =>
      array (
        'driver' => 'file',
        'path' => '/home/marjan/WebSites/iauahvazSoft/storage/framework/cache/data',
      ),
      'memcached' =>
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' =>
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' =>
        array (
        ),
        'servers' =>
        array (
          0 =>
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' =>
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel_cache',
  ),
  'database' =>
  array (
    'default' => 'mysql',
    'connections' =>
    array (
      'sqlite' =>
      array (
        'driver' => 'sqlite',
        'database' => 'iauahvaz',
        'prefix' => '',
      ),
      'mysql' =>
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'iauahvaz',
        'username' => 'root',
        'password' => '123',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => NULL,
      ),
      'pgsql' =>
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'iauahvaz',
        'username' => 'root',
        'password' => '123',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' =>
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'iauahvaz',
        'username' => 'root',
        'password' => '123',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' =>
    array (
      'client' => 'predis',
      'default' =>
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'filesystems' =>
  array (
    'default' => 'public',
    'cloud' => 's3',
    'disks' =>
    array (
      'local' =>
      array (
        'driver' => 'local',
        'root' => '/home/marjan/WebSites/iauahvazSoft/storage/app',
      ),
      'public' =>
      array (
        'driver' => 'local',
        'root' => '/home/marjan/WebSites/iauahvazSoft/storage/app/public',
        'url' => 'http://localhost:8000/storage',
        'visibility' => 'public',
      ),
      's3' =>
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
      ),
    ),
  ),
  'image' =>
  array (
    'driver' => 'gd',
  ),
  'mail' =>
  array (
    'driver' => 'smtp',
    'host' => 'at2.datacenterland.com',
    'port' => '465',
    'from' =>
    array (
      'address' => 'noreply@riratech.ir',
      'name' => 'Recovery Password',
    ),
    'encryption' => 'SSL',
    'username' => 'noreply@riratech.ir',
    'password' => 'abc123!@#',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' =>
    array (
      'theme' => 'default',
      'paths' =>
      array (
        0 => '/home/marjan/WebSites/iauahvazSoft/resources/views/vendor/mail',
      ),
    ),
  ),
  'queue' =>
  array (
    'default' => 'database',
    'connections' =>
    array (
      'sync' =>
      array (
        'driver' => 'sync',
      ),
      'database' =>
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' =>
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' =>
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' =>
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
      ),
    ),
    'failed' =>
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' =>
  array (
    'mailgun' =>
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' =>
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' =>
    array (
      'secret' => NULL,
    ),
    'stripe' =>
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' =>
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home/marjan/WebSites/iauahvazSoft/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' =>
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'smsir' =>
  array (
    'middlewares' =>
    array (
      0 => 'web',
    ),
    'route' => 'sms-admin',
    'api-key' => 'a4d6fbcdd8c2d367d4d2fee8',
    'secret-key' => 'ArghavanSecretKey',
    'line-number' => '30004747474626',
    'db-log' => true,
    'panel-routes' => true,
    'title' => 'مدیریت پیامک ها',
    'in-page' => '15',
  ),
  'tinker' =>
  array (
    'dont_alias' =>
    array (
    ),
  ),
  'trustedproxy' =>
  array (
    'proxies' =>
    array (
      0 => '192.168.1.10',
    ),
    'headers' =>
    array (
      1 => 'FORWARDED',
    ),
  ),
  'view' =>
  array (
    'paths' =>
    array (
      0 => '/home/marjan/WebSites/iauahvazSoft/resources/views',
    ),
    'compiled' => '/home/marjan/WebSites/iauahvazSoft/storage/framework/views',
  ),
  'dompdf' =>
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' =>
    array (
      'font_dir' => '/home/marjan/WebSites/iauahvazSoft/storage/fonts/',
      'font_cache' => '/home/marjan/WebSites/iauahvazSoft/storage/fonts/',
      'temp_dir' => '/tmp',
      'chroot' => '/home/marjan/WebSites/iauahvazSoft',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'tcpdf' =>
  array (
    'page_format' => 'A4',
    'page_orientation' => 'P',
    'page_units' => 'mm',
    'unicode' => true,
    'encoding' => 'UTF-8',
    'font_directory' => '',
    'image_directory' => '',
    'tcpdf_throw_exception' => false,
    'use_fpdi' => false,
    'use_original_header' => false,
    'use_original_footer' => false,
  ),
);
