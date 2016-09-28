<?php
return array(
    'app' => array(
        'url'  => 'http://localhost',
        'hash' => array(
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10
        )
    ),

    'db' => array(
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'name'      => 'application',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => ''
    ),

    'auth' => array(
        'session'  => 'user_id',
        'remember' => 'user_r'
    ),

    'mail' => array(
	    'smtp_auth'       => true,
	    'smtp_secure'     => 'tls',
	    'host'            => 'smtp.frostweb.co.za',
	    'username'        => 'no-reply@frostweb.co.za',
	    'password'        => '',
	    'port'            => 587,
	    'html'            => true,
	    'sendfrom_email'  => 'No-Reply@frostweb.co.za',
	    'sendfrom_person' => 'No-Reply'
    ),

    'twig' => array(
        'debug'       => true,
    ),

    'csrf' => array(
        'key' => 'csrf_token'
    )
);