<?php

return [
  'auth' => [
    'defaults' => [
      'guard'     => 'web',
      'passwords' => 'users',
    ],
    'guards' => [
      'web' => [
        'driver'   => 'session',
        'provider' => 'users',
      ],
      'api' => [
        'driver'   => 'token',
        'provider' => 'users',
      ],
    ],
    'providers' => [
      'users' => [
        'driver' => 'eloquent',
        'model'  => 'App\\User',
      ],
    ],
    'passwords' => [
      'users' => [
        'provider' => 'users',
        'table'    => 'password_resets',
        'expire'   => 60,
      ],
    ],
  ],
  'cache' => [
    'default' => 'file',
    'stores'  => [
      'apc' => [
        'driver' => 'apc',
      ],
      'array' => [
        'driver' => 'array',
      ],
      'database' => [
        'driver'     => 'database',
        'table'      => 'cache',
        'connection' => null,
      ],
      'file' => [
        'driver' => 'file',
        'path'   => '/var/www/html/MyBlog/storage/framework/cache/data',
      ],
      'memcached' => [
        'driver'        => 'memcached',
        'persistent_id' => null,
        'sasl'          => [
          0 => null,
          1 => null,
        ],
        'options' => [
        ],
        'servers' => [
          0 => [
            'host'   => '127.0.0.1',
            'port'   => 11211,
            'weight' => 100,
          ],
        ],
      ],
      'redis' => [
        'driver'     => 'redis',
        'connection' => 'default',
      ],
    ],
    'prefix' => 'laravel',
  ],
  'services' => [
    'mailgun' => [
      'domain' => null,
      'secret' => null,
    ],
    'ses' => [
      'key'    => null,
      'secret' => null,
      'region' => 'us-east-1',
    ],
    'sparkpost' => [
      'secret' => null,
    ],
    'stripe' => [
      'model'  => 'App\\User',
      'key'    => null,
      'secret' => null,
    ],
  ],
  'broadcasting' => [
    'default'     => 'pusher',
    'connections' => [
      'pusher' => [
        'driver'  => 'pusher',
        'key'     => '794f9fb9d1383578634e',
        'secret'  => '7c83554e9f794296a813',
        'app_id'  => '498409',
        'options' => [
          'cluster'   => 'ap1',
          'encrypted' => true,
        ],
      ],
      'redis' => [
        'driver'     => 'redis',
        'connection' => 'default',
      ],
      'log' => [
        'driver' => 'log',
      ],
      'null' => [
        'driver' => 'null',
      ],
    ],
  ],
  'app' => [
    'name'            => 'Laravel',
    'env'             => 'local',
    'debug'           => true,
    'url'             => 'http://localhost/',
    'timezone'        => 'UTC',
    'locale'          => 'en',
    'fallback_locale' => 'en',
    'key'             => 'base64:sZTBAv6JNBKnEkbms6ZuDyVMws36TspBV9sy34ZzcPs=',
    'cipher'          => 'AES-256-CBC',
    'log'             => 'single',
    'log_level'       => 'debug',
    'providers'       => [
      0  => 'Illuminate\\Auth\\AuthServiceProvider',
      1  => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2  => 'Illuminate\\Bus\\BusServiceProvider',
      3  => 'Illuminate\\Cache\\CacheServiceProvider',
      4  => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5  => 'Illuminate\\Cookie\\CookieServiceProvider',
      6  => 'Illuminate\\Database\\DatabaseServiceProvider',
      7  => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8  => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9  => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
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
      22 => 'Collective\\Html\\HtmlServiceProvider',
      23 => 'Laravel\\Tinker\\TinkerServiceProvider',
      24 => 'App\\Providers\\AppServiceProvider',
      25 => 'App\\Providers\\AuthServiceProvider',
      26 => 'App\\Providers\\BroadcastServiceProvider',
      27 => 'App\\Providers\\EventServiceProvider',
      28 => 'App\\Providers\\RouteServiceProvider',
      29 => 'Intervention\\Image\\ImageServiceProvider',
      30 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ],
    'aliases' => [
      'App'          => 'Illuminate\\Support\\Facades\\App',
      'Artisan'      => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth'         => 'Illuminate\\Support\\Facades\\Auth',
      'Blade'        => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast'    => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus'          => 'Illuminate\\Support\\Facades\\Bus',
      'Cache'        => 'Illuminate\\Support\\Facades\\Cache',
      'Config'       => 'Illuminate\\Support\\Facades\\Config',
      'Cookie'       => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt'        => 'Illuminate\\Support\\Facades\\Crypt',
      'DB'           => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent'     => 'Illuminate\\Database\\Eloquent\\Model',
      'Event'        => 'Illuminate\\Support\\Facades\\Event',
      'File'         => 'Illuminate\\Support\\Facades\\File',
      'Gate'         => 'Illuminate\\Support\\Facades\\Gate',
      'Hash'         => 'Illuminate\\Support\\Facades\\Hash',
      'Lang'         => 'Illuminate\\Support\\Facades\\Lang',
      'Log'          => 'Illuminate\\Support\\Facades\\Log',
      'Mail'         => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password'     => 'Illuminate\\Support\\Facades\\Password',
      'Queue'        => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect'     => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis'        => 'Illuminate\\Support\\Facades\\Redis',
      'Request'      => 'Illuminate\\Support\\Facades\\Request',
      'Response'     => 'Illuminate\\Support\\Facades\\Response',
      'Route'        => 'Illuminate\\Support\\Facades\\Route',
      'Schema'       => 'Illuminate\\Support\\Facades\\Schema',
      'Session'      => 'Illuminate\\Support\\Facades\\Session',
      'Storage'      => 'Illuminate\\Support\\Facades\\Storage',
      'URL'          => 'Illuminate\\Support\\Facades\\URL',
      'Validator'    => 'Illuminate\\Support\\Facades\\Validator',
      'View'         => 'Illuminate\\Support\\Facades\\View',
      'Form'         => 'Collective\\Html\\FormFacade',
      'Html'         => 'Collective\\Html\\HtmlFacade',
      'Image'        => 'Intervention\\Image\\Facades\\Image',
      'Pusher'       => 'Pusher\\Pusher',
      'Excel'        => 'Maatwebsite\\Excel\\Facades\\Excel',
    ],
  ],
  'queue' => [
    'default'     => 'sync',
    'connections' => [
      'sync' => [
        'driver' => 'sync',
      ],
      'database' => [
        'driver'      => 'database',
        'table'       => 'jobs',
        'queue'       => 'default',
        'retry_after' => 90,
      ],
      'beanstalkd' => [
        'driver'      => 'beanstalkd',
        'host'        => 'localhost',
        'queue'       => 'default',
        'retry_after' => 90,
      ],
      'sqs' => [
        'driver' => 'sqs',
        'key'    => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue'  => 'your-queue-name',
        'region' => 'us-east-1',
      ],
      'redis' => [
        'driver'      => 'redis',
        'connection'  => 'default',
        'queue'       => 'default',
        'retry_after' => 90,
      ],
    ],
    'failed' => [
      'database' => 'mysql',
      'table'    => 'failed_jobs',
    ],
  ],
  'mail' => [
    'driver' => 'smtp',
    'host'   => 'smtp.mailtrap.io',
    'port'   => '465',
    'from'   => [
      'address' => 'Francy@truplus.vn',
      'name'    => 'Laravel',
    ],
    'encryption' => 'tls',
    'username'   => '1af2d9ef8d5ce1',
    'password'   => '18945cba3c838c',
    'sendmail'   => '/usr/sbin/sendmail -bs',
    'markdown'   => [
      'theme' => 'default',
      'paths' => [
        0 => '/var/www/html/MyBlog/resources/views/vendor/mail',
      ],
    ],
  ],
  'session' => [
    'driver'          => 'file',
    'lifetime'        => 1000,
    'expire_on_close' => false,
    'encrypt'         => false,
    'files'           => '/var/www/html/MyBlog/storage/framework/sessions',
    'connection'      => null,
    'table'           => 'sessions',
    'store'           => null,
    'lottery'         => [
      0 => 2,
      1 => 100,
    ],
    'cookie'    => 'laravel_session',
    'path'      => '/',
    'domain'    => null,
    'secure'    => false,
    'http_only' => true,
  ],
  'filesystems' => [
    'default' => 'local',
    'cloud'   => 's3',
    'disks'   => [
      'local' => [
        'driver' => 'local',
        'root'   => '/var/www/html/MyBlog/public/imgs/',
      ],
      'public' => [
        'driver'     => 'local',
        'root'       => '/var/www/html/MyBlog/storage/app/public',
        'url'        => 'http://localhost//storage',
        'visibility' => 'public',
      ],
      's3' => [
        'driver' => 's3',
        'key'    => null,
        'secret' => null,
        'region' => null,
        'bucket' => null,
      ],
    ],
  ],
  'database' => [
    'default'     => 'mysql',
    'connections' => [
      'sqlite' => [
        'driver'   => 'sqlite',
        'database' => 'blogv2',
        'prefix'   => '',
      ],
      'mysql' => [
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'port'      => '3306',
        'database'  => 'blogv2',
        'username'  => 'root',
        'password'  => 'birth5716',
        'charset'   => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix'    => '',
        'strict'    => true,
        'engine'    => null,
      ],
      'mysql_2' => [
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'port'      => '3306',
        'database'  => 'learn_english',
        'username'  => 'root',
        'password'  => 'birth5716',
        'charset'   => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix'    => '',
        'strict'    => true,
        'engine'    => null,
      ],
      'mysql_3' => [
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'port'      => '3306',
        'database'  => 'website_crawler',
        'username'  => 'root',
        'password'  => 'birth5716',
        'charset'   => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix'    => '',
        'strict'    => true,
        'engine'    => null,
      ],
      'emotional_dictionaries' => [
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'port'      => '3306',
        'database'  => 'web_mining',
        'username'  => 'root',
        'password'  => 'birth5716',
        'charset'   => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix'    => '',
        'strict'    => true,
        'engine'    => null,
      ],
      'pgsql' => [
        'driver'   => 'pgsql',
        'host'     => '127.0.0.1',
        'port'     => '3306',
        'database' => 'blogv2',
        'username' => 'root',
        'password' => 'birth5716',
        'charset'  => 'utf8',
        'prefix'   => '',
        'schema'   => 'public',
        'sslmode'  => 'prefer',
      ],
    ],
    'migrations' => 'migrations',
    'redis'      => [
      'client'  => 'predis',
      'default' => [
        'host'     => '127.0.0.1',
        'password' => null,
        'port'     => '6379',
        'database' => 0,
      ],
    ],
  ],
  'view' => [
    'paths' => [
      0 => '/var/www/html/MyBlog/resources/views',
    ],
    'compiled' => '/var/www/html/MyBlog/storage/framework/views',
  ],
  'image' => [
    'driver' => 'gd',
  ],
  'excel' => [
    'cache' => [
      'enable'   => true,
      'driver'   => 'memory',
      'settings' => [
        'memoryCacheSize' => '32MB',
        'cacheTime'       => 600,
      ],
      'memcache' => [
        'host' => 'localhost',
        'port' => 11211,
      ],
      'dir' => '/var/www/html/MyBlog/storage/cache',
    ],
    'properties' => [
      'creator'        => 'Maatwebsite',
      'lastModifiedBy' => 'Maatwebsite',
      'title'          => 'Spreadsheet',
      'description'    => 'Default spreadsheet export',
      'subject'        => 'Spreadsheet export',
      'keywords'       => 'maatwebsite, excel, export',
      'category'       => 'Excel',
      'manager'        => 'Maatwebsite',
      'company'        => 'Maatwebsite',
    ],
    'sheets' => [
      'pageSetup' => [
        'orientation'           => 'portrait',
        'paperSize'             => '9',
        'scale'                 => '100',
        'fitToPage'             => false,
        'fitToHeight'           => true,
        'fitToWidth'            => true,
        'columnsToRepeatAtLeft' => [
          0 => '',
          1 => '',
        ],
        'rowsToRepeatAtTop' => [
          0 => 0,
          1 => 0,
        ],
        'horizontalCentered' => false,
        'verticalCentered'   => false,
        'printArea'          => null,
        'firstPageNumber'    => null,
      ],
    ],
    'creator' => 'Maatwebsite',
    'csv'     => [
      'delimiter'   => ',',
      'enclosure'   => '"',
      'line_ending' => '
',
      'use_bom' => false,
    ],
    'export' => [
      'autosize'                    => true,
      'autosize-method'             => 'approx',
      'generate_heading_by_indices' => true,
      'merged_cell_alignment'       => 'left',
      'calculate'                   => false,
      'includeCharts'               => false,
      'sheets'                      => [
        'page_margin'          => false,
        'nullValue'            => null,
        'startCell'            => 'A1',
        'strictNullComparison' => false,
      ],
      'store' => [
        'path'       => '/var/www/html/MyBlog/storage/exports',
        'returnInfo' => false,
      ],
      'pdf' => [
        'driver'  => 'DomPDF',
        'drivers' => [
          'DomPDF' => [
            'path' => '/var/www/html/MyBlog/vendor/dompdf/dompdf/',
          ],
          'tcPDF' => [
            'path' => '/var/www/html/MyBlog/vendor/tecnick.com/tcpdf/',
          ],
          'mPDF' => [
            'path' => '/var/www/html/MyBlog/vendor/mpdf/mpdf/',
          ],
        ],
      ],
    ],
    'filters' => [
      'registered' => [
        'chunk' => 'Maatwebsite\\Excel\\Filters\\ChunkReadFilter',
      ],
      'enabled' => [
      ],
    ],
    'import' => [
      'heading'        => 'slugged',
      'startRow'       => 1,
      'separator'      => '_',
      'slug_whitelist' => '._',
      'includeCharts'  => false,
      'to_ascii'       => true,
      'encoding'       => [
        'input'  => 'UTF-8',
        'output' => 'UTF-8',
      ],
      'calculate'               => true,
      'ignoreEmpty'             => false,
      'force_sheets_collection' => false,
      'dates'                   => [
        'enabled' => true,
        'format'  => false,
        'columns' => [
        ],
      ],
      'sheets' => [
        'test' => [
          'firstname' => 'A2',
        ],
      ],
    ],
    'views' => [
      'styles' => [
        'th' => [
          'font' => [
            'bold' => true,
            'size' => 12,
          ],
        ],
        'strong' => [
          'font' => [
            'bold' => true,
            'size' => 12,
          ],
        ],
        'b' => [
          'font' => [
            'bold' => true,
            'size' => 12,
          ],
        ],
        'i' => [
          'font' => [
            'italic' => true,
            'size'   => 12,
          ],
        ],
        'h1' => [
          'font' => [
            'bold' => true,
            'size' => 24,
          ],
        ],
        'h2' => [
          'font' => [
            'bold' => true,
            'size' => 18,
          ],
        ],
        'h3' => [
          'font' => [
            'bold' => true,
            'size' => 13.5,
          ],
        ],
        'h4' => [
          'font' => [
            'bold' => true,
            'size' => 12,
          ],
        ],
        'h5' => [
          'font' => [
            'bold' => true,
            'size' => 10,
          ],
        ],
        'h6' => [
          'font' => [
            'bold' => true,
            'size' => 7.5,
          ],
        ],
        'a' => [
          'font' => [
            'underline' => true,
            'color'     => [
              'argb' => 'FF0000FF',
            ],
          ],
        ],
        'hr' => [
          'borders' => [
            'bottom' => [
              'style' => 'thin',
              'color' => [
                0 => 'FF000000',
              ],
            ],
          ],
        ],
      ],
    ],
  ],
  'tinker' => [
    'dont_alias' => [
    ],
  ],
];
