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
		'host'      => 'localhost',
		'database'  => 'application',
		'username'  => 'michael',
		'password'  => 'test',
		'charset'   => 'utf8',
		'collation' => 'utf8_general_ci',
		'prefix'    => '',
		'port'      => 33066
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
		'debug' => false,
	),
	
	'csrf' => array(
		'key' => 'csrf_token'
	),
	
	'mailchimp' => array(
		'api_key'     => '91ce56b2213df17f59e3986a8c0548a4-us14',
		'web_listing' => '62967cf0c5'
	)
);