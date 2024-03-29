<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\LoginFilter;
use App\Filters\LoginFirstFilter;
use App\Filters\UsersFilter;
use App\Filters\AdminFilter;
use App\Filters\AuditorFilter;
use App\Filters\LeaderFilter;
use App\Filters\LoginPageFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'login'         => LoginFilter::class,
        'loginfirst'    => LoginFirstFilter::class,
        'users'         => UsersFilter::class,
        'admin'         => AdminFilter::class,
        'auditor'       => AuditorFilter::class,
        'leader'        => LeaderFilter::class,
        'loginpage'     => LoginPageFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'loginfirst' => [
            'before' => [
                '/',
            ],
        ],
        'login' => [
            'before' => [
                'home',
                'home/*',
                'admin',
                'admin/*',
                'auditor',
                'auditor/*',
                'leader',
                'leader/*',
            ],
        ],
        'users' => [
            'before' => [
                '/',
                'home',
                'home/*',
            ],
        ],
        'admin' => [
            'before' => [
                'admin',
                'admin/*',
            ],
        ],
        'auditor' => [
            'before' => [
                'auditor',
                'auditor/*',
            ],
        ],
        'leader' => [
            'before' => [
                'leader',
                'leader/*',
            ],
        ],
        'loginpage' => [
            'before' => [
                'login',
            ],
        ],
    ];
}
