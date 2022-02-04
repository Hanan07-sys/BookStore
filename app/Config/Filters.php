<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'auth'     => \App\Filters\AuthFilter::class,
		'admin'     => \App\Filters\AdminFilter::class,
		'user'     => \App\Filters\UserFilter::class,

	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			//'honeypot'
			'csrf',
			'auth' => ['except' => [
				'login', 'login/*',
			]],
			'user'=>['except' => [
				'login','login/*'
			]],
			'admin'=>['except' => [
				'login','login/*'
			]]

		],
		
		'after'  => [
			'toolbar',
			'user'=>['except' => [
				'user','user/*','login/logout'
			]],
			'admin'=>['except' => [
				'novel','novel/*','login/logout','home','genre','genre/*','bahasa','bahasa/*','pengguna','pengguna/*','Cetak','Cetak/*',
			]],

			//'honeypot'
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
	public $filters = [];
}
